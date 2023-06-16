<?php

use Illuminate\Database\Seeder;

class WebsiteThemePagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $count = DB::table('website_theme_pages')->count();        
            
        if ($count==0) {
            DB::table('website_theme_pages')->insert(
                [
                    'website_theme_id'=> '1',
                    'name'=> 'index',
                    'title' =>null,
                    'meta_keywords'=> null,
                    'meta_description' =>null,
                    'header_includes' =>null,
                    'preview' =>null,
                    'template'=> null,
                    'css'=> null,
                    'created_at' =>  date('Y-m-d H:i:s'),
                    'updated_at' =>  date('Y-m-d H:i:s')
                ]
            );   
        }                
        

    }
}