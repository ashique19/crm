<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteFramesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'website_frames', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('page_id');
                $table->integer('website_id');
                $table->text('content');
                $table->integer('height');
                $table->string('original_url');
                $table->string('loaderfunction')->nullable();
                $table->boolean('sandbox');
                $table->boolean('revision')->default(0);
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
        Schema::drop('website_frames');
    }
}
