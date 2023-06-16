<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'websites', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->integer('website_theme_id');                
                $table->string('website_name');
                $table->string('subdomain');
                $table->string('primary_domain')->nullable();
                $table->integer('theme_id')->nullable();
                $table->string('logo')->nullable();
                $table->text('description')->nullable();
                $table->text('keywords')->nullable();
                $table->string('seo_image')->nullable();
                $table->string('business_name')->nullable();
                $table->string('business_phone')->nullable();
                $table->string('business_email')->nullable();
                $table->string('business_address')->nullable();
                $table->string('business_address_2')->nullable();
                $table->string('business_city')->nullable();
                $table->string('business_state')->nullable();
                $table->string('business_zip')->nullable();
                $table->string('business_country')->nullable();
                $table->boolean('monday')->default(0);
                $table->time('monday_start')->nullable();
                $table->time('monday_end')->nullable();
                $table->boolean('tuesday')->default(0);
                $table->time('tuesday_start')->nullable();
                $table->time('tuesday_end')->nullable();
                $table->boolean('wednesday')->default(0);
                $table->time('wednesday_start')->nullable();
                $table->time('wednesday_end')->nullable();
                $table->boolean('thursday')->default(0);
                $table->time('thursday_start')->nullable();
                $table->time('thursday_end')->nullable();
                $table->boolean('friday')->default(0);
                $table->time('friday_start')->nullable();
                $table->time('friday_end')->nullable();
                $table->boolean('saturday')->default(0);
                $table->time('saturday_start')->nullable();
                $table->time('saturday_end')->nullable();
                $table->boolean('sunday')->default(0);
                $table->time('sunday_start')->nullable();
                $table->time('sunday_end')->nullable();
                $table->string('google_tag')->nullable();
                $table->text('header_tag')->nullable();
                $table->text('footer_tag')->nullable();
                $table->string('ftp_server')->nullable();
                $table->string('ftp_user')->nullable();
                $table->string('ftp_password')->nullable();
                $table->string('ftp_path')->nullable();
                $table->integer('ftp_port')->nullable();
                $table->boolean('ftp_ok')->nullable();
                $table->boolean('ftp_published')->nullable();
                $table->integer('publish_date')->nullable();
                $table->text('global_css')->nullable();
                $table->string('remote_url')->nullable();
                $table->boolean('website_trashed')->default('0');
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
        Schema::drop('websites');
    }
}
