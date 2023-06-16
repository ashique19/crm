<?php
namespace App\Models\SiteBuilder;
use Auth;
use Storage;
use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use App\Models\Website as Site;
use App\Models\WebsiteSetting as Setting;

class Exportation
{
    protected $site;
    protected $setting;
    protected $tmpPath;
    protected $zip;
    public function __construct(Site $site)
    {
        $this->site = $site;
        $this->setting = Setting::all();
        $this->zip = new ZipArchive;
        $user = Auth::user();
        $this->tmpPath = "tmp/{$user->id}{$this->site->id}/";
    }
    
    public function getFilename()
    {
        return $this->setting->where('name', 'export_fileName')->first()->value;
    }
    public function generateZipFile($pages, $doctype)
    {
        $filename = $this->getFilename();
        // ---- Path ---- //
        $dirPrefix = Storage::disk('sitebuilder-source')->getDriver()
            ->getAdapter()->getPathPrefix();
        $tmpPath = $dirPrefix . $this->tmpPath;
        
        $tmpPath = "/home/cptest/public_html/public/tmp/";
        
        if (!is_dir($tmpPath)) {
            mkdir($tmpPath);
        }
        
        $tmpPath = $tmpPath.'/'.$filename;
        
        // ---- Create Zip file in temporary directory ---- //
        $this->zip->open($tmpPath, ZipArchive::CREATE);
        $this->addAssets();
        $this->addPages($pages, $doctype);
        $this->zip->close();
        
        return $tmpPath;
    }
    protected function addAssets()
    {
        $assetsPath = $this->setting->where('name', 'export_pathToAssets')->first();
        $assets = explode('|', $assetsPath->value);
        foreach ($assets as $asset) {
            $dirs = explode('/', $asset);
            end($dirs);
            $lastKey = key($dirs);
            $assetOf = $dirs[$lastKey];
            $prefix = "assets/";
            
            // Create recursive directory iterator
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($asset), RecursiveIteratorIterator::LEAVES_ONLY
            );
            
            foreach ($files as $name => $file) {
                if ($file->getFilename() != '.' && $file->getFilename() != '..') {
                    // Get real path for current file
                    $filePath = $file->getRealPath();
                                        
                    if ($asset == $this->setting->where('name', 'images_dir')->first()->value) {
                        // Check if this is a user file
                        if (strpos($file, '/uploads') !== false) {
                            if (strpos($file, '/uploads/' . Auth::user()->id . '/') !== false || Auth::user()->type == 'admin') {
                                // Add current file to archive
                                $this->zip->addFile($filePath, $name);
                                //echo $filePath."<br>";
                            }
                        } else {
                            // Add current file to archive
                            $this->zip->addFile($filePath, $name);
                            //echo $filePath."<br>";
                        }
                    } else {
                        // Add current file to archive
                        $this->zip->addFile($filePath, $name);
                        //echo $filePath."<br>";
                    }
                }
            }
        }
    }
    
    public function addPages($pages, $doctype)
    {
        $site = $this->site;
        
        foreach ($pages as $page => $content) {
            $meta = '';
            $pageMeta = $site->pages()->where('name', $page)->first();
            
            if ($pageMeta) {
                $meta .= '<title>' . $pageMeta->title . '</title>' . "\r\n";
                $meta .= '<meta name="keywords" content="' . $pageMeta->meta_keywords . '">' . "\r\n";
                $meta .= '<meta name="description" content="' . $pageMeta->meta_description . '">' . "\r\n";
                $pageContent = str_replace('<!--pageMeta-->', $meta, $content);
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
                
                $pageContent = str_replace("<!--headerIncludes-->", $includesPlusCss, $pageContent);
                // Remove frameCovers
                $pageContent = str_replace('<div class="frameCover" data-type="video"></div>', "", $pageContent);
            } else {
                $pageContent = $content;
            }
            
            $this->zip->addFromString($page . ".html", $doctype . "\n" . stripslashes($pageContent));
        }
    }
}
