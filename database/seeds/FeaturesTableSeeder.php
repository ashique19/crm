<?php

use Illuminate\Database\Seeder;

class FeaturesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        if (App::environment('local')) {
            \DB::table('features')->delete();
            
            \DB::table('features')->insert(
                array (
            
                0 => 
                array (
                'id' => 1,
                'description' => 'Unlimited Pages',
                'created_at' => '2018-09-19 11:44:10',
                'updated_at' => '2018-09-19 11:44:10',
                ),
                
                1 => 
                array (
                'id' => 2,
                'description' => 'Web Hosting & Security',
                'created_at' => '2018-09-19 11:44:10',
                'updated_at' => '2018-09-19 11:44:10',
                ),      

                2 => 
                array (
                'id' => 3,
                'description' => 'Mobile Responsive Design',
                'created_at' => '2018-09-19 11:44:10',
                'updated_at' => '2018-09-19 11:44:10',
                ),       

                3 => 
                array (
                'id' => 4,
                'description' => 'Unlimited Tech Support',
                'created_at' => '2018-09-19 11:44:10',
                'updated_at' => '2018-09-19 11:44:10',
                ),      

                4 => 
                array (
                'id' => 5,
                'description' => 'Online Appointment System',
                'created_at' => '2018-09-19 11:44:10',
                'updated_at' => '2018-09-19 11:44:10',
                ),             
                
                5 => 
                array (
                'id' => 6,
                'description' => 'Domain Registration & Renewal',
                'created_at' => '2018-09-19 11:44:10',
                'updated_at' => '2018-09-19 11:44:10',
                ),     

                6 => 
                array (
                'id' => 7,
                'description' => 'Credit Card Processing',
                'created_at' => '2018-09-19 11:44:10',
                'updated_at' => '2018-09-19 11:44:10',
                ),              
                
                7 => 
                array (
                'id' => 8,
                'description' => 'Pre-Written Therapist Content',
                'created_at' => '2018-09-19 11:44:10',
                'updated_at' => '2018-09-19 11:44:10',
                ),           

                8 => 
                array (
                'id' => 9,
                'description' => 'Ready to Use Forms',
                'created_at' => '2018-09-19 11:44:10',
                'updated_at' => '2018-09-19 11:44:10',
                ),            

                9 => 
                array (
                'id' => 10,
                'description' => 'Client Management Tools',
                'created_at' => '2018-09-19 11:44:10',
                'updated_at' => '2018-09-19 11:44:10',
                ),              

                10 => 
                array (
                'id' => 11,
                'description' => 'Ongoing Professional SEO',
                'created_at' => '2018-09-19 11:44:10',
                'updated_at' => '2018-09-19 11:44:10',
                ),            

                11 => 
                array (
                'id' => 12,
                'description' => 'HIPAA Compliant Technology',
                'created_at' => '2018-09-19 11:44:10',
                'updated_at' => '2018-09-19 11:44:10',
                ),               

                12 => 
                array (
                'id' => 13,
                'description' => 'Video Sessions',
                'created_at' => '2018-09-19 11:44:10',
                'updated_at' => '2018-09-19 11:44:10',
                ), 
                
                13 => 
                array (
                'id' => 14,
                'description' => 'Everything in Startup',
                'created_at' => '2018-09-19 11:44:10',
                'updated_at' => '2018-09-19 11:44:10',
                ),        

                14 => 
                array (
                'id' => 15,
                'description' => 'Everything in Standard',
                'created_at' => '2018-09-19 11:44:10',
                'updated_at' => '2018-09-19 11:44:10',
                ),              

                )
            );
        }        

        
    }
}
