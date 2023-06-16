<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'website_blogs', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('website_id');
                $table->string('title');
                $table->string('content');  
                $table->string('image');                
                $table->string('slug');
                $table->text('meta_keywords')->nullable();
                $table->text('meta_description')->nullable();
                $table->integer('views');                
                $table->integer('status');                
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
        Schema::drop('website_blogs');
    }
}
