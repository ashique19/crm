<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFooterIncludesToWebsitePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'website_pages', function (Blueprint $table) {
                $table->text('footer_includes')->after('header_includes')->nullable();
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
        Schema::table(
            'website_pages', function (Blueprint $table) {
                $table->dropColumn('footer_includes');
            }
        );
    }
}
