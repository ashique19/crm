<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteThemeFramesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'website_theme_frames', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('website_theme_page_id');
                $table->text('content');
                $table->integer('height');
                $table->string('original_url');
                $table->string('loaderfunction')->nullable();
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
        Schema::drop('website_theme_frames');
    }
}
