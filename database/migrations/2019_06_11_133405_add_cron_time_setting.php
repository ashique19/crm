<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCronTimeSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        \DB::table('settings')->insert(
            array (
            0 => 
            array (
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // do nothing
    }
}
