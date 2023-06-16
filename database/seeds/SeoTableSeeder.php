<?php

use Illuminate\Database\Seeder;

class SeoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        if (App::environment('local')) {
            \DB::table('seo')->delete();
            
            \DB::table('seo')->insert(
                array (
                0 => 
                array (
                'id' => 1,
                'url' => 'features',                    
                'title' => 'Features  | PsychNook',
                'description' => 'PsychNook therapy platform features include built-in search engine optimization, online booking system, and online webcam counseling and much more.',
                'created_at' => '2018-09-19 12:22:46',
                'updated_at' => '2018-09-19 12:22:46',
                ),
                1 => 
                array (
                        'id' => 2,
                        'url' => '',                    
                        'title' => 'PsychNook | Therapist Web Platform',
                        'description' => 'PsychNook builds high performing websites for therapists. We are the #1 therapist website platform and only platform to offer web counselling built into your website for one low fee.',
                        'created_at' => '2018-09-19 12:22:46',
                        'updated_at' => '2018-09-19 12:22:46',
                ),     
                2 => 
                array (
                        'id' => 3,
                        'url' => 'subscription',                    
                        'title' => 'Subscribe | PsychNook',
                        'description' => 'PsychNook builds high performing websites for therapists. We are the #1 therapist website platform and only platform to offer web counselling built into your website for one low fee.',
                        'created_at' => '2018-09-19 12:22:46',
                        'updated_at' => '2018-09-19 12:22:46',
                ),    
                3 => 
                array (
                        'id' => 4,
                        'url' => 'blog',                    
                        'title' => 'Blog | PsychNook',
                        'description' => 'PsychNook builds high performing websites for therapists. We are the #1 therapist website platform and only platform to offer web counselling built into your website for one low fee.',
                        'created_at' => '2018-09-19 12:22:46',
                        'updated_at' => '2018-09-19 12:22:46',
                ),   
                4 => 
                array (
                        'id' => 5,
                        'url' => 'careers',                    
                        'title' => 'Careers | PsychNook',
                        'description' => 'PsychNook builds high performing websites for therapists. We are the #1 therapist website platform and only platform to offer web counselling built into your website for one low fee.',
                        'created_at' => '2018-09-19 12:22:46',
                        'updated_at' => '2018-09-19 12:22:46',
                ),      
                5 => 
                array (
                        'id' => 6,
                        'url' => 'contact',                    
                        'title' => 'Contact Us | PsychNook',
                        'description' => 'PsychNook builds high performing websites for therapists. We are the #1 therapist website platform and only platform to offer web counselling built into your website for one low fee.',
                        'created_at' => '2018-09-19 12:22:46',
                        'updated_at' => '2018-09-19 12:22:46',
                ),             
                6 => 
                array (
                        'id' => 7,
                        'url' => 'designs',                    
                        'title' => 'Designs | PsychNook',
                        'description' => 'PsychNook builds high performing websites for therapists. We are the #1 therapist website platform and only platform to offer web counselling built into your website for one low fee.',
                        'created_at' => '2018-09-19 12:22:46',
                        'updated_at' => '2018-09-19 12:22:46',
                ),    
                7 => 
                array (
                        'id' => 8,
                        'url' => 'faq',                    
                        'title' => 'Frequently Asked Questions | PsychNook',
                        'description' => 'Frequently Asked Questions',
                        'created_at' => '2018-09-19 12:22:46',
                        'updated_at' => '2018-09-19 12:22:46',
                ),               
                8 => 
                array (
                        'id' => 9,
                        'url' => 'login',                    
                        'title' => 'Login | PsychNook',
                        'description' => null,
                        'created_at' => '2018-09-19 12:22:46',
                        'updated_at' => '2018-09-19 12:22:46',
                ),                 
                9 => 
                array (
                        'id' => 10,
                        'url' => 'terms-of-service',                    
                        'title' => 'Terms of Service | PsychNook',
                        'description' => null,
                        'created_at' => '2018-09-19 12:22:46',
                        'updated_at' => '2018-09-19 12:22:46',
                ),      
                10 => 
                array (
                        'id' => 11,
                        'url' => 'acceptable-use-policy',                    
                        'title' => 'Acceptable Use Policy | PsychNook',
                        'description' => null,
                        'created_at' => '2018-09-19 12:22:46',
                        'updated_at' => '2018-09-19 12:22:46',
                ), 
                11 => 
                array (
                        'id' => 12,
                        'url' => 'privacy-policy',                    
                        'title' => 'Privacy Policy | PsychNook',
                        'description' => null,
                        'created_at' => '2018-09-19 12:22:46',
                        'updated_at' => '2018-09-19 12:22:46',
                ),  
                12 => 
                array (
                        'id' => 13,
                        'url' => 'plans',                    
                        'title' => 'Get Started | PsychNook',
                        'description' => 'Get Started with PsychNook Today',
                        'created_at' => '2018-09-19 12:22:46',
                        'updated_at' => '2018-09-19 12:22:46',
                ),               
                13 => 
                array (
                        'id' => 14,
                        'url' => 'support',                    
                        'title' => 'Support | PsychNook',
                        'description' => null,
                        'created_at' => '2018-09-19 12:22:46',
                        'updated_at' => '2018-09-19 12:22:46',
                ),                               
                )
            );
        }        

        
    }
}
