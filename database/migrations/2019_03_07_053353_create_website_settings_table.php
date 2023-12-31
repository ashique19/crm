<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'website_settings', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->text('value');
                $table->text('default_value');
                $table->text('description');
                $table->boolean('required');
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
        Schema::drop('website_settings');
    }
}
