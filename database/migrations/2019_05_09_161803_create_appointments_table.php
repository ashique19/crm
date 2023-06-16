<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'appointments', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->integer('appointment_availability_id');
                $table->integer('appointment_service_id');
                $table->enum('appointment_type', ['1', '2', '3', '4'])->comment('1 = in-person, 2 = webcam, 3 = phone, 4 = messaging');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email');
                $table->string('phone');                     
                $table->boolean('email_notification')->default(false);
                $table->boolean('sms_notification')->default(false);                
                $table->boolean('active')->default(false);
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
        Schema::dropIfExists('appointments');
    }
}
