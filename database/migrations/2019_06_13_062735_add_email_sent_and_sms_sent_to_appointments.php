<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailSentAndSmsSentToAppointments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'appointments', function (Blueprint $table) {
                $table->boolean('email_sent')->default(false)->after('email_notification');
                $table->boolean('sms_sent')->default(false)->after('sms_notification');
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
            'appointments', function (Blueprint $table) {
                $table->dropColumn(['email_sent',  'sms_sent']);
            }
        );
    }
}
