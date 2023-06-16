<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'appointment_reviews', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->integer('appointment_id');
                $table->integer('rating');
                $table->text('review');
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
        Schema::dropIfExists('appointment_reviews');
    }
}
