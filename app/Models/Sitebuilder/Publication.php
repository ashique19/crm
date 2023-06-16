<?php

namespace App\Models\SiteBuilder;

use Auth;
use Storage;
use App\Library\FTP\CI_FTP;
use App\Models\Website as Site;
use App\Models\WebsiteSetting as Setting;

class Publication
{

    protected $setting;
    protected $site;
    protected $ftp;
    
    protected $localPath;
    protected $localAssetPath;
    protected $tmpPath;

    public function __construct(Site $site)
    {

        $this->site = $site;

        $this->setting = Setting::all();

        $this->ftp = $this->getFTP();

        $user = Auth::user();
        
        $this->localPath = "{$user->id}/{$this->site->id}/";

        $this->tmpPath = "tmp/{$user->id}{$this->site->id}/";
    }

    protected function ftpPath($string = '')
    {
        $site = $this->site;

        if (trim($site->ftp_path) == '/') {
            return $string;
        } else {
            return trim($site->ftp_path) . $string;
        }
    }
    
    /**
     * Create directory recursively
     * 
     * @param type void
     */
    protected function ftpCreateDirs($string)
    {
        $dirs = explode('/', $string);
                
        foreach ($dirs as $dir) {
            $this->ftp->mkdir($dir);
            $this->ftp->changedir($dir);
        }
    }

    /**
     * 
     * @return CI_FTP
     */
    protected function getFTP()
    {
        $site = $this->site;
        
        if (empty($site->ftp_server) || empty($site->ftp_user) || empty($site->ftp_password)) {
            return false;
        }
        
        $ftp = new CI_FTP;

        $config = array(
            'hostname' => $site->ftp_server,
            'username' => $site->ftp_user,
            'password' => $site->ftp_password,
            'port' => $site->ftp_port,
        );

        $isConnected = $ftp->connect($config);
        
        if ($isConnected) {
            return $ftp;
        } else {
            return false;
        }
    }

    public function publishAsset($item)
    {
        if (!$this->ftp) {
            return $this->publishAssetToLocalStorage($item);
        } else {
            return $this->publishAssetToFTP($item);
        }
    }

    public function publishAssetToLocalStorage($item)
    {
        $setting = $this->setting;
        $user = Auth::user();
        $localPath = $this->localPath;

        // If user request to publish images asset 
        // (need to carefully not to publish other user uploads directory)
        if ($item == $setting->where('name', 'images_dir')->first()->value) {
            $pathPrefix = $setting->where('name', 'images_dir')->first()->value;
            $storage = Storage::disk('public_root');
            $storage->getDriver()->getAdapter()->setPathPrefix($pathPrefix);
            $images = $storage->allFiles();

            foreach ($images as $image) {
                $imgDirs = explode('/', $image);

                if (!in_array('uploads', $imgDirs) 
                    || (in_array('uploads', $imgDirs) && in_array($user->id, $imgDirs))
                ) {
                    Storage::disk('sitebuilder-sites')
                        ->put("{$localPath}{$pathPrefix}/{$image}", $storage->get($image));
                }
            } // End foreach
        } // End if
        // If user request to publish assets other than images/
        else {
            $path = explode('/', $item);
            end($path);
            $lastKey = key($path);
            
            $pathPrefix = $setting->where('name', 'elements_dir')->first()->value;
            $storage = Storage::disk('public_root');
            $storage->getDriver()->getAdapter()->setPathPrefix($pathPrefix);

            $files = $storage->allFiles($path[$lastKey]);

            foreach ($files as $file) {
                Storage::disk('sitebuilder-sites')
                    ->put("{$localPath}{$pathPrefix}/{$file}", $storage->get($file));
            }
        }

        return true;
    }

    public function publishAssetToFTP($item)
    {
        if (!$this->ftp) {
            throw new \Exception('Incorrect FTP');

            return false;
        }

        // Prevent timeout
        set_time_limit(0);

        $ftp = $this->ftp;
        $setting = $this->setting;

        // If user request to publish default images asset
        if ($item == $setting->where('name', 'images_dir')->first()->value) {
            $imagePathPrefix = $setting->where('name', 'images_dir')->first()->value;
            $imageSourcePath = public_path($imagePathPrefix) . '/';
            $imageFtpPath = $this->ftpPath("/{$imagePathPrefix}/");

            // Create dir if the images/ directory is not exists in the FTP
            if (!$ftp->list_files($imageFtpPath)) {
                $this->ftpCreateDirs($imagePathPrefix);
            }

            $dirMap = directory_map($imageSourcePath, 2);

            foreach ($dirMap as $key => $entry) {
                if (is_array($entry)) {
                    // Folder, do all but take special care of /uploads
                    if ($key != 'uploads/') {
                        $ftp->mirror("{$imageSourcePath}{$key}", "{$imageFtpPath}{$key}");
                    }

                    // Take special care of the uploads folder
                    else {
                        $user = Auth::user();
                        $imageUploadsPathPrefix = $setting->where('name', 'images_uploadDir')->first()->value;
                        $imageUploadsSourcePath = public_path($imageUploadsPathPrefix) . '/';
                        $imageUploadsFtpPath = $this->ftpPath("/{$imageUploadsPathPrefix}/");
                        
                        // Create dir if the images/uploads/ directory is not exists in the FTP
                        if (!$ftp->list_files($imageUploadsFtpPath)) {
                            $this->ftpCreateDirs($imageUploadsPathPrefix);
                        }

                        $imageUploadsSourceMap = directory_map($imageUploadsSourcePath, 1);

                        foreach ($imageUploadsSourceMap as $userIDFolder) {
                            if ($userIDFolder == "{$user->id}/") {
                                // Create dir if the images/uploads/ directory is not exists in the FTP
                                if (!$ftp->list_files($imageUploadsFtpPath)) {
                                    $ftp->mkdir($imageUploadsFtpPath);
                                }

                                $ftp->mirror("{$imageUploadsSourcePath}{$userIDFolder}", "{$imageUploadsFtpPath}");
                            }
                        }
                    }
                } else {
                    $ftp->upload("{$imageSourcePath}{$entry}", "{$imageFtpPath}{$entry}");
                }
            } // End foreach
        } // End if
        // If user request to publish assets
        else {
            $sourcePath = public_path("{$item}/");
            $ftpPath = $this->ftpPath("/{$item}/");
            
            // Create dir if the images/ directory is not exists in the FTP
            if (!$ftp->list_files($ftpPath)) {
                $this->ftpCreateDirs($item);
            }
            
            $ftp->mirror($sourcePath, $ftpPath);
        }

        return true;
    }

    public function publishPage($item, $pageContent)
    {
        $user = Auth::user();
        
        if (!$this->ftp) {
            $this->publishPageToLocalStorage($item, $pageContent);
        } else {
            $this->publishPageToFTP($item, $pageContent);
        }
        
        return true;
    }
    
    public function publishPageToLocalStorage($item, $pageContent)
    {
        $filename = $this->createTempPage($item, $pageContent);
        Storage::disk('sitebuilder-sites')->put("{$this->localPath}{$item}.html", Storage::disk('sitebuilder-source')->get($filename));
        Storage::disk('sitebuilder-source')->deleteDirectory($this->tmpPath, true);
        
        return true;
    }

    public function publishPageToFTP($item, $pageContent)
    {
        $ftp = $this->ftp;
        $site = $this->site;
        $filename = $this->createTempPage($item, $pageContent);
        
        set_time_limit(0);//prevent timeout

        $dirPrefix = Storage::disk('sitebuilder-source')->getDriver()->getAdapter()->getPathPrefix();
        $dirPath = $dirPrefix . $this->tmpPath;

        $ftp->mirror($dirPath, $this->ftpPath() . "/");
        Storage::disk('sitebuilder-source')->deleteDirectory($this->tmpPath, true);
        
        return true;
    }
    
    protected function createTempPage($item, $pageContent)
    {
        $site = $this->site;
        $meta = '';
        $pageMeta = $this->site->pages()->where('name', $item)->first();

        if ($pageMeta) {
            // Insert title, meta keywords and meta description
            $meta .= '<title>' . $pageMeta->title . '</title>' . "\r\n";
            $meta .= '<meta name="keywords" content="' . $pageMeta->meta_keywords . '">' . "\r\n";
            $meta .= '<meta name="description" content="' . $pageMeta->meta_description . '">';

            $pageContent = str_replace('<!--pageMeta-->', $meta, $pageContent);

            // Insert header includes;
            $includesPlusCss = '';
            if ($pageMeta->header_includes != '') {
                $includesPlusCss .= $pageMeta->header_includes;
            }
            
            if ($pageMeta->css != '') {
                $includesPlusCss .= "\n<style>" . $pageMeta->css . "</style>\n";
            }
            
            if ($site->global_css != '') {
                $includesPlusCss .= "\n<style>" . $site->global_css . "</style>\n";
            }
            
            // Insert header includes;
            $pageContent = str_replace("<!--headerIncludes-->", $includesPlusCss, $pageContent);
        }
        
        $pageContent = "<!-- DOCTYPE html -->\n" . $pageContent;
        $filename = "{$this->tmpPath}{$item}.html";
        Storage::disk('sitebuilder-source')->put($filename, $pageContent);
        
        return $filename;
    }
}
