<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotificationEmailFieldsToWebsites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'websites', function (Blueprint $table) {
                $table->integer('notification_email_port')->after('footer_tag')->nullable();        
                $table->string('notification_email_server')->after('footer_tag')->nullable();    
                $table->string('notification_email_password')->after('footer_tag')->nullable();                
                $table->string('notification_email_address')->after('footer_tag')->nullable();
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
            'websites', function (Blueprint $table) {
                $table->dropColumn('notification_email_address');
                $table->dropColumn('notification_email_password');
                $table->dropColumn('notification_email_server');
                $table->dropColumn('notification_email_port');                
            }
        );
    }
}
