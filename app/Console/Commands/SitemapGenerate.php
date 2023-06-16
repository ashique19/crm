<?php
namespace App\Console\Commands;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;
use App\Models\City;
use App\Models\Setting;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
class SitemapGenerate extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $NUM_OF_ATTEMPTS = 5;
        $attempts = 0;
        do {
            try
            {               

                $files = glob(public_path('sitemap*.xml'));
                foreach($files as $file) {
                    unlink($file);   
                }    
        
                SitemapGenerator::create(config('app.url'))->hasCrawled(
                    function (Url $url) {
                        if (\strpos($url->path(), '.php') !== false) {
                            return;
                        }
                        if (\strpos($url->path(), '.jpg') !== false) {
                            return;
                        }  
                        if (\strpos($url->path(), 'user-register') !== false) {
                            return;
                        }    
                        if (\strpos($url->path(), 'redirect') !== false) {
                            return;
                        }                           
                        return $url;
                    }
                )
                ->writeToFile(public_path('sitemap1.xml'));
         
                // get total keyword count 
                $keywordCount = Setting::where('key', 'LIKE', '%local_page_keyword%')->where('value', '<>', null)->count();
                // get total city count         
                $cityCount = City::where('status', '1')->count();
        
                // get total keyword * city count
        
                $totalCount = $keywordCount * $cityCount;
                if($keywordCount>=1 && $totalCount>20000) {
                    $totalCount = 2 + round($totalCount / 20000);
                } elseif($keywordCount>=1) {
                    // if count less than 20k set to 3
                    $totalCount = 3;
                } else {
                    // if no keywords set count to 0
                    $totalCount = 0;
                }
                $keywords = Setting::where('key', 'LIKE', '%local_page_keyword%')->where('value', '<>', null)->get();     
        
                $lastid = 0;
        
                if($keywordCount>=1) {
                    for( $i = 2; $i < $totalCount; $i++)
                    {
                            $sitemap = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">';
                        $take = 20000 / $keywordCount;
        
                        $urls = City::where('id', '>', $lastid)->where('status', '1')->take($take)->get();
                        foreach($urls as $url) {
                    
                    
                            foreach($keywords as $keyword) {
                        
                                    $sitemap .= "<url>
                    <loc>".config('app.url')."/".$keyword->value."-".$url->content_url."/</loc>
                    <lastmod>".date('Y-m-d')."</lastmod>
                    <changefreq>yearly</changefreq>
                    <priority>0.5</priority>
                     </url>";            
                        
                            }                   
             
                             $lastid = $url->id;
                        }
        
                        $sitemap .= '</urlset>';
                        if(!Storage::disk('public_root')->put('sitemap'.$i.'.xml', $sitemap)) {
                            return false;
                        }
            
                        unset($sitemap);
                    }
                }
           
        
                $index = '<?xml version="1.0" encoding="UTF-8"?>
        <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
            <sitemap>
                <loc>'.config("app.url").'/sitemap1.xml</loc>   
                <lastmod>'.date('c', time()).'</lastmod>
            </sitemap>';
                if($keywordCount>=1) {
                    for( $i = 2; $i < $totalCount; $i++)  
                        {
                        $index .="<sitemap>
                        <loc>".config('app.url')."/sitemap".$i.".xml</loc>
                        <lastmod>".date('c', time())."</lastmod>
                    </sitemap>
                    "; 
                    }            
                }
                $index .= '</sitemapindex>';
                if(!Storage::disk('public_root')->put('sitemap.xml', $index)) {
                    echo 'failure'.PHP_EOL;
                    return false;
                }
        
            } catch (\Exception $exception) {
                echo $exception.''.PHP_EOL;
                $attempts++;
                sleep(60);
                continue;
            }
            break;
        } while($attempts < $NUM_OF_ATTEMPTS);           
          
    }
}
