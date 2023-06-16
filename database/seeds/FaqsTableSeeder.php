<?php

use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        if (App::environment('local')) {
            \DB::table('faqs')->delete();
            
            \DB::table('faqs')->insert(
                array (
                0 => 
                array (
                'id' => 1,
                'title' => 'Is support included?',
                'description' => 'Of course! All plans include support, simply submit a support ticket. All you have to do is email us and one of our team members will get it taken care of with utmost priority.',
                'category_id' => 1,
                'language' => 'en',
                'created_at' => '2018-09-19 12:22:46',
                'updated_at' => '2018-09-19 12:22:46',
                ),
                1 => 
                array (
                        'id' => 2,
                        'title' => 'Are your websites mobile friendly?',
                        'description' => 'All PsychNook websites are 100% mobile responsive.',
                        'category_id' => 1,
                        'language' => 'en',
                        'created_at' => '2018-09-19 12:23:30',
                        'updated_at' => '2018-09-19 12:23:30',
                ),
                2 => 
                array (
                        'id' => 3,
                        'title' => 'Are your sites search engine optimized?',
                        'description' => 'All PsychNook sites are technically optimized to meet the requirements of all major search engines such as google, yahoo, and bing.',
                        'category_id' => 1,
                        'language' => 'en',
                        'created_at' => '2018-09-19 12:24:15',
                        'updated_at' => '2018-09-19 12:24:15',
                ),
                3 => 
                array (
                        'id' => 4,
                        'title' => 'Can my site be customized?',
                        'description' => 'Our easy to use tool provides you the ability to completely customize your site. Every detail of your site can be easily modified to meet your requirements.',
                        'category_id' => 1,
                        'language' => 'en',
                        'created_at' => '2018-09-19 12:24:40',
                        'updated_at' => '2018-09-19 12:24:40',
                ),
                4 => 
                array (
                        'id' => 5,
                        'title' => 'How does a client choose between a message, audio, or a video session?',
                        'description' => 'At session initiation, you get to choose. If your client does not have a webcam, or has a very slow connection, audio will obviously be the best option. Chat is good if you have a client concerned with anonymity, or has significant technology issues.',
                        'category_id' => 1,
                        'language' => 'en',
                        'created_at' => '2018-09-19 12:25:10',
                        'updated_at' => '2018-09-19 12:25:10',
                ),
                5 => 
                array (
                        'id' => 6,
                        'title' => 'What happens if a client or myself has a technical issue during a counselling session?',
                        'description' => 'There is a chat-based live help function in the browser that can assist. If there is an internet outage, the session can simply be restarted.',
                        'category_id' => 1,
                        'language' => 'en',
                        'created_at' => '2018-09-19 12:25:41',
                        'updated_at' => '2018-09-19 12:25:41',
                ),
                6 => 
                array (
                        'id' => 7,
                        'title' => 'How does the instant availability feature work?',
                        'description' => 'If you are sitting at your desk and have available time, you can log-in to the system and turn on Instant Availability Mode. This will create an “Available Now” icon on your profile. A client can then click on your profile and initiate a session.',
                        'category_id' => 1,
                        'language' => 'en',
                        'created_at' => '2018-09-19 12:25:41',
                        'updated_at' => '2018-09-19 12:25:41',
                ),  
                7 => 
                array (
                        'id' => 8,
                        'title' => 'Can I keep my domain name?',
                        'description' => 'Absolutely! Once you sign up, we will ask you for your domain name and we will provide you instructions on how to point your domain to our services.',
                        'category_id' => 1,
                        'language' => 'en',
                        'created_at' => '2018-09-19 12:25:41',
                        'updated_at' => '2018-09-19 12:25:41',
                ),         
                8 => 
                array (
                        'id' => 9,
                        'title' => 'How secure is your platform?',
                        'description' => 'PsychNook websites and hosted counseling sessions are SSL-encrypted from end-to-end. PsychNook uses the latest systems to ensure data security and integrity. Credit card processing and data systems are also PCI-compliant.',
                        'category_id' => 1,
                        'language' => 'en',
                        'created_at' => '2018-09-19 12:25:41',
                        'updated_at' => '2018-09-19 12:25:41',
                ),     
                9 => 
                array (
                        'id' => 10,
                        'title' => 'Will you help me make changes?',
                        'description' => 'Absolutely! Just open up a support ticket with what you need help and we happily jump in and help!',
                        'category_id' => 1,
                        'language' => 'en',
                        'created_at' => '2018-09-19 12:25:41',
                        'updated_at' => '2018-09-19 12:25:41',
                ),     
                10 => 
                array (
                        'id' => 11,
                        'title' => 'What are the technical requirements for the video counseling component?',
                        'description' => 'In order for webcams to function properly, both parties need to have a reasonably fast, stable internet connection (above 100 bps). Basic broadband will typically be ample. The included Chat or Audio Only modes operate well at much slower speeds, and if your client doesn’t have a webcam. In addition, both parties need the latest version of either Chrome, Firefox, IE, Safari, or Opera. IE and Safari both require installation of a plug-in. This is an automatic process and simply requires user agreement to install the plug-in. The user will be prompted to allow installation at the beginning of the session.',
                        'category_id' => 1,
                        'language' => 'en',
                        'created_at' => '2018-09-19 12:25:41',
                        'updated_at' => '2018-09-19 12:25:41',
                ),                   
                )
            );
        }        
        
        
    }
}