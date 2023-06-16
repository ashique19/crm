<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{


    public function stripeSeed()
    {
        
        if (App::environment('local')) {
            \DB::table('plans')->delete();

            \DB::table('plans')->insert(
                array (
                0 =>
                array (
                'id' => 1,
                'name' => 'Startup',
                'slug' => 'startup',
                'orderby' => 1,
                'featured' => 0,
                'description' => '',
                'gateway_id' => 'plan_Esl9AwMsGy3M5I',
                'price' => '39.00',
                'active' => 1,
                'teams_limit' => 24,
                'storage_limit' => 24,
                'created_at' => '2018-09-16 16:10:54',
                'updated_at' => null,
                ),
                1 =>
                array (
                        'id' => 2,
                        'name' => 'Standard',
                        'slug' => 'standard',
                        'orderby' => 2,
                        'featured' => 1,
                        'description' => '',
                        'gateway_id' => 'plan_Esl9AwMsGy3M5I',
                        'price' => '99.00',
                        'active' => 1,
                        'teams_limit' => 50,
                        'storage_limit' => 100,
                        'created_at' => '2018-09-16 16:10:54',
                        'updated_at' => null,
                ),
                2 =>
                array (
                        'id' => 3,
                        'name' => 'Premium',
                        'slug' => 'premium',
                        'orderby' => 3,
                        'featured' => 0,
                        'description' => '',
                        'gateway_id' => 'plan_Esl9AwMsGy3M5I',
                        'price' => '199.00',
                        'active' => 1,
                        'teams_limit' => null,
                        'storage_limit' => null,
                        'created_at' => '2018-09-16 16:10:54',
                        'updated_at' => null,
                ),
                )
            );
        }        

    }

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
            $this->stripeSeed();
    }
}