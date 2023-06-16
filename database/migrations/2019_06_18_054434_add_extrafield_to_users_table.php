<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtrafieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'users', function (Blueprint $table) {
                $table->string('company_name')->nullable();
                $table->string('address')->nullable();
                $table->string('state')->nullable();
                $table->string('country')->nullable();
                $table->string('city')->nullable();
                $table->string('phone')->nullable();
                $table->string('payment_type')->nullable();
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
            'users', function (Blueprint $table) {
                $table->dropColumn(['company_name',  'address', 'state','country','city','phone','payment_type']);
            }
        );
    }
}
