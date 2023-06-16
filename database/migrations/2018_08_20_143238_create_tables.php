<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {



        Schema::create(
            'newsletter', function (Blueprint $table) {
                $table->increments('id');
                $table->string('email');
                $table->timestamps();
            }
        );
        
        Schema::create(
            'features', function (Blueprint $table) {
                $table->increments('id');
                $table->text('description');
                $table->timestamps();
            }
        );        
        
        Schema::create(
            'designs', function (Blueprint $table) {
                $table->increments('id');
                $table->text('description');
                $table->string('main_image');
                $table->integer('orderby')->default(0);
                $table->string('goto')->nullable();
                $table->string('language');
                $table->timestamps();
            }
        );

        Schema::create(
            'faq_categories', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->string('language');
                $table->timestamps();
            }
        );

        Schema::create(
            'faqs', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->text('description');
                $table->integer('category_id');
                $table->string('language');
                $table->timestamps();
            }
        );

        Schema::create(
            'jobs', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->integer('orderby')->default(0);
                $table->string('goto')->nullable();
                $table->text('description');
                $table->string('language');
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
        Schema::drop('newsletter');
        Schema::drop('designs');
        Schema::drop('faq_categories');
        Schema::drop('faqs');
        Schema::drop('jobs');
    }
}
