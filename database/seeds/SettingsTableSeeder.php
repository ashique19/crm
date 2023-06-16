<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
  
        if (App::environment('local')) {
            \DB::table('settings')->delete();
            
            \DB::table('settings')->insert(
                array (
                0 => 
                array (
                'id' => 1,
                'key' => 'site.contact_form_email',
                'display_name' => 'Contact Form Email',
                'value' => 'contact@domain.com',
                'details' => '',
                'type' => 'image',
                'order' => 1,
                'group' => 'Site',
                ),
                1 => 
                array (
                'id' => 2,
                'key' => 'site.google_analytics_tracking_id',
                'display_name' => 'Google Analytics',
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 2,
                'group' => 'Site',
                ),
                2 => 
                array (
                'id' => 3,
                'key' => 'site.google_map_key',
                'display_name' => 'Google Map Key',
                'value' => 'AIzaSyB3taZXWKMveB8-MU2Z4ZfUcqf0_qgztpw',
                'details' => '',
                'type' => 'image',
                'order' => 3,
                'group' => 'Site',
                ),
                3 => 
                array (
                'id' => 4,
                'key' => 'site.google_recaptcha_api_public_key',
                'display_name' => 'Google Recaptcha Public Key',
                'value' => '6Lf4A5EUAAAAAMxf2OmPKr0-xABg6LUbUC51Ue8A',
                'details' => '',
                'type' => 'text',
                'order' => 4,
                'group' => 'Site',
                ),
                4 => 
                array (
                'id' => 5,
                'key' => 'site.google_recaptcha_api_secret_key',
                'display_name' => 'Google Recaptcha Secret Key',
                'value' => '6Lf4A5EUAAAAAD91foYxnjit-2xhO8v9mIH-TeO5',
                'details' => '',
                'type' => 'text',
                'order' => 5,
                'group' => 'Site',
                ),
                5 => 
                array (
                'id' => 6,
                'key' => 'site.social.facebook',
                'display_name' => 'Facebook',
                'value' => 'psychnook',
                'details' => '',
                'type' => 'text',
                'order' => 6,
                'group' => 'Site',
                ),
                6 => 
                array (
                'id' => 7,
                'key' => 'site.social.twitter',
                'display_name' => 'Twitter',
                'value' => 'psychnook',
                'details' => '',
                'type' => 'text',
                'order' => 7,
                'group' => 'Site',
                ),
                7 => 
                array (
                'id' => 8,
                'key' => 'site.social.linkedin',
                'display_name' => 'Linkedin',
                'value' => 'psychnook',
                'details' => '',
                'type' => 'text',
                'order' => 8,
                'group' => 'Site',
                ),      
                8 => 
                array (
                'id' => 9,
                'key' => 'site.social.vimeo',
                'display_name' => 'Vimeo',
                'value' => 'psychnook',
                'details' => '',
                'type' => 'text',
                'order' => 9,
                'group' => 'Site',
                ),          
                9 => 
                array (
                'id' => 10,
                'key' => 'site.social.youtube',
                'display_name' => 'Youtube',
                'value' => 'psychnook',
                'details' => '',
                'type' => 'text',
                'order' => 9,
                'group' => 'Site',
                ),       
                10 => 
                array (
                'id' => 11,
                'key' => 'site.social.stumbleupon',
                'display_name' => 'Stumbleupon',
                'value' => 'psychnook',
                'details' => '',
                'type' => 'text',
                'order' => 9,
                'group' => 'Site',
                ),                
                11 => 
                array (
                'id' => 12,
                'key' => 'site.footer.description',
                'display_name' => 'Footer Description',
                'value' => 'PsychNook is a web platform designed for counselors and coaches. We handle all your technology and marketing needs so you can spend time on what matters, your clients.',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Site',
                ),
                12 => 
                array (
                'id' => 13,
                'key' => 'site.color.primary',
                'display_name' => 'Primary Color',
                'value' => '7BC4BE',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Site',
                ),      
                13 => 
                array (
                'id' => 14,
                'key' => 'site.cron_run_time',
                'display_name' => 'Cron Run Time',
                'value' => '10:00',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Site',
                ),            
                )
            );
        }  
        
    }
}