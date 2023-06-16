<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'website_analytics', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('website_id');
                $table->string('url');  
                $table->string('referrer');                  
                $table->string('ip');    
                $table->string('device');   
                $table->string('device_version');                  
                $table->string('browser');       
                $table->string('browser_version');                 
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('website_analytics');
    }
}
