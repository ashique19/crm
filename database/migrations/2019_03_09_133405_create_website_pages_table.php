<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsitePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'website_pages', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('website_id');
                $table->string('name');
                $table->string('title')->nullable();
                $table->text('meta_keywords')->nullable();
                $table->text('meta_description')->nullable();
                $table->text('header_includes')->nullable();
                $table->text('preview')->nullable();
                $table->boolean('template')->nullable();
                $table->text('css')->nullable();
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
        Schema::drop('website_pages');
    }
}
