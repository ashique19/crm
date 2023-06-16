<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContentUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // \DB::table('users')->insert(
        //     array (
        //     0 =>
        //     array (
        //     'role_id' => 1,
        //     'name' => 'Content User',
        //     'email' => 'content@content.com',
        //     'avatar' => 'users/September2018/HkxhQr3ESLHXCTCEGibY.png',
        //     'password' => Hash::make('greatcontent123'),
        //     'application_id' => null,
        //     'remember_token' => 'xuA69jqONwX9XOCxehIoZoQOsKgYLEP1sVWtZyBZffJdct8mTgp144Kvtwc5',
        //     'created_at' => '2018-09-16 16:11:09',
        //     'updated_at' => '2018-09-19 19:06:23',
        //     'activated' => 0,
        //     'stripe_id' => null,
        //     'card_brand' => null,
        //     'card_last_four' => null,
        //     'trial_ends_at' => null,
        //     'deleted_at' => null,
        //     'provider' => null,
        //     'provider_id' => null,
        //     ),
        //     )
        // );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // do nothing
    }
}
