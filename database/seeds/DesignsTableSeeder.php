<?php

use Illuminate\Database\Seeder;

class DesignsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        if (App::environment('local')) {
            \DB::table('designs')->delete();

            \DB::table('designs')->insert(
                array (
                0 =>
                array (
                'id' => 1,
                'description' => '',
                'main_image' => '5c477bc0b6e814ffc.jpg',
                'orderby' => 1,
                'goto' => 'http://cptest.com',
                'language' => 'en',
                'created_at' => '2018-09-19 11:51:00',
                'updated_at' => '2018-09-19 12:00:46',
                ),
                1 =>
                array (
                'id' => 2,
                'description' => '',
                'main_image' => '5c477bc0b6e814ffc.jpg',
                'orderby' => 2,
                'goto' => 'http://cptest.com',
                'language' => 'en',
                'created_at' => '2018-09-19 11:58:14',
                'updated_at' => '2018-09-19 11:58:14',
                ),
                2 =>
                array (
                'id' => 3,
                'description' => '',
                'main_image' => '5c477bc0b6e814ffc.jpg',
                'orderby' => 3,
                'goto' => 'http://cptest.com',
                'language' => 'en',
                'created_at' => '2018-09-19 12:03:00',
                'updated_at' => '2018-09-19 12:04:37',
                ),
                3 =>
                array (
                'id' => 4,
                'description' => '',
                'main_image' => '5c477bc0b6e814ffc.jpg',
                'orderby' => 4,
                'goto' => 'http://cptest.com',
                'language' => 'en',
                'created_at' => '2018-09-19 12:06:00',
                'updated_at' => '2018-09-19 12:06:33',
                ),
                4 =>
                array (
                'id' => 5,
                'description' => '',
                'main_image' => '5c477bc0b6e814ffc.jpg',
                'orderby' => 5,
                'goto' => 'http://cptest.com',
                'language' => 'en',
                'created_at' => '2018-09-19 12:08:00',
                'updated_at' => '2018-09-19 12:08:45',
                ),
                5 =>
                array (
                'id' => 6,
                'description' => '',
                'main_image' => '5c477bc0b6e814ffc.jpg',
                'orderby' => 6,
                'goto' => 'http://cptest.com',
                'language' => 'en',
                'created_at' => '2018-09-19 12:10:00',
                'updated_at' => '2018-09-19 12:11:13',
                ),
                )
            );
        }

    }
}
