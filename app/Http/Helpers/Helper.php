<?php

use App\Models\Language;
use App\Models\Seo;
use App\Models\Setting;

// Getting Settings Values
if(!function_exists('setting')) {
    function setting($key, $type = null)
    {
        $setting = Setting::where('key', $key)->first();
        if($setting) {
            return ($setting->value == '[null]' || $setting->value == '') ? '' : $setting->value;
        }else{
            return '';
        }
    }
}

// Getting Settings Values
if(!function_exists('seo')) {
    function seo($key)
    {
        $seo = Seo::where('url', ltrim(Request::getRequestUri(), '/'))->first();
        if($seo) {
            return ($seo->$key == '[null]' || $seo->$key == '') ? '' : $seo->$key;
        }else{
            return '';
        }        
        
    }
}

// Getting Language Values
if(!function_exists('lang')) {
    function lang($key, $type = null)
    {
        $language = Language::where('key', $key)->first();
        if($language) {
            return ($language->value == '[null]' || $language->value == '') ? '' : $language->value;
        }else{
            return '';
        }
    }
}

if (! function_exists('on_page')) {
    function on_page($path)
    {
        return request()->is($path);
    }
}

if (! function_exists('return_if')) {
    function return_if($condition, $value)
    {
        if ($condition) {
            return $value;
        }
    }
}

// Start Sitebuilder Helpers------------------------------------------------------------------------

if (! function_exists('write_file')) {
    /**
     * Write File
     *
     * Writes data to the file specified in the path.
     * Creates a new file if non-existent.
     *
     * @param  string $path File path
     * @param  string $data Data to write
     * @param  string $mode fopen() mode (default: 'wb')
     * @return bool
     */
    function write_file($path, $data, $mode = 'wb')
    {
        if (! $fp = @fopen($path, $mode)) {
            return false;
        }

        flock($fp, LOCK_EX);

        for ($result = $written = 0, $length = strlen($data); $written < $length; $written += $result)
        {
            if (($result = fwrite($fp, substr($data, $written))) === false) {
                break;
            }
        }

        flock($fp, LOCK_UN);
        fclose($fp);

        return is_int($result);
    }
}

// ------------------------------------------------------------------------
//
// ------------------------------------------------------------------------

if (! function_exists('directory_map')) {
    /**
     * Create a Directory Map
     *
     * Reads the specified directory and builds an array
     * representation of it. Sub-folders contained with the
     * directory will be mapped as well.
     *
     * @param  string $source_dir      Path to source
     * @param  int    $directory_depth Depth of directories to traverse                             
     * @param  bool   $hidden          Whether to show hidden files
     * @return array
     */
    function directory_map($source_dir, $directory_depth = 0, $hidden = false)
    {
        if ($fp = @opendir($source_dir)) {
            $filedata    = array();
            $new_depth    = $directory_depth - 1;
            $source_dir    = rtrim($source_dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;

            while (false !== ($file = readdir($fp)))
            {
                // Remove '.', '..', and hidden files [optional]
                if ($file === '.' OR $file === '..' OR ($hidden === false && $file[0] === '.')) {
                    continue;
                }

                is_dir($source_dir.$file) && $file .= DIRECTORY_SEPARATOR;

                if (($directory_depth < 1 OR $new_depth > 0) && is_dir($source_dir.$file)) {
                    $filedata[$file] = directory_map($source_dir.$file, $new_depth, $hidden);
                }
                else
                {
                    $filedata[] = $file;
                }
            }

            closedir($fp);
            return $filedata;
        }

        return false;
    }
}

// End Sitebuilder Helpers------------------------------------------------------------------------
