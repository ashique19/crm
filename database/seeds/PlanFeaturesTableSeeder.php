<?php

use Illuminate\Database\Seeder;

class PlanFeaturesTableSeeder extends Seeder
{

    public function planFeatureSeed()
    {
        
        if (App::environment('local')) {
            \DB::table('plan_features')->delete();

            \DB::table('plan_features')->insert(
                array (
                0 =>
                array (
                'id' => 1,
                'plan_id' => '1',
                'feature_id' => '1',
                'sort_order' => 1,
                        ),
                1 =>
                        array (
                            'id' => 2,
                            'plan_id' => '1',
                            'feature_id' => '2',
                            'sort_order' => 2,
                        ),         
                2 =>
                        array (
                            'id' => 3,
                            'plan_id' => '1',
                            'feature_id' => '3',
                            'sort_order' => 3,
                        ),              
                3 =>
                        array (
                            'id' => 4,
                            'plan_id' => '1',
                            'feature_id' => '4',
                            'sort_order' => 4,
                        ),     
                4 =>
                        array (
                            'id' => 5,
                            'plan_id' => '1',
                            'feature_id' => '5',
                            'sort_order' => 5,
                        ),      

                5 =>
                        array (
                            'id' => 6,
                            'plan_id' => '2',
                            'feature_id' => '14',
                            'sort_order' => 1,
                        ),
                6 =>
                        array (
                            'id' => 7,
                            'plan_id' => '2',
                            'feature_id' => '6',
                            'sort_order' => 2,
                        ),         
                7 =>
                        array (
                            'id' => 8,
                            'plan_id' => '2',
                            'feature_id' => '7',
                            'sort_order' => 3,
                        ),              
                8 =>
                        array (
                            'id' => 9,
                            'plan_id' => '2',
                            'feature_id' => '8',
                            'sort_order' => 4,
                        ),     
                9 =>
                        array (
                            'id' => 10,
                            'plan_id' => '2',
                            'feature_id' => '9',
                            'sort_order' => 5,
                        ),   

                10 =>
                        array (
                            'id' => 11,
                            'plan_id' => '3',
                            'feature_id' => '15',
                            'sort_order' => 1,
                        ),
                11 =>
                        array (
                            'id' => 12,
                            'plan_id' => '3',
                            'feature_id' => '10',
                            'sort_order' => 2,
                        ),         
                12 =>
                        array (
                            'id' => 13,
                            'plan_id' => '3',
                            'feature_id' => '11',
                            'sort_order' => 3,
                        ),              
                13 =>
                        array (
                            'id' => 14,
                            'plan_id' => '3',
                            'feature_id' => '12',
                            'sort_order' => 4,
                        ),     
                14 =>
                        array (
                            'id' => 15,
                            'plan_id' => '3',
                            'feature_id' => '13',
                            'sort_order' => 5,
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
            $this->planFeatureSeed();
    }
}
