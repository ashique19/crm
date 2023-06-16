<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        if (App::environment('local')) {
            \DB::table('users')->delete();

            \DB::table('users')->insert(
                array (
                0 =>
                array (
                'id' => 1,
                'role_id' => 1,
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'avatar' => 'users/September2018/HkxhQr3ESLHXCTCEGibY.png',
                'password' => Hash::make('password'),
                'application_id' => null,
                'remember_token' => 'xuA69jqONwX9XOCxehIoZoQOsKgYLEP1sVWtZyBZffJdct8mTgp144Kvtwc5',
                'created_at' => '2018-09-16 16:11:09',
                'updated_at' => '2018-09-19 19:06:23',
                'activated' => 0,
                'stripe_id' => null,
                'card_brand' => null,
                'card_last_four' => null,
                'trial_ends_at' => null,
                'deleted_at' => null,
                'provider' => null,
                'provider_id' => null,
                ),
                1 =>
                array (
                'id' => 2,
                'role_id' => 2,
                'name' => 'Provider User',
                'email' => 'provider@provider.com',
                'avatar' => 'users/default.png',
                'password' => Hash::make('password'),
                'application_id' => '2',
                'remember_token' => '4Ai7MnEyJq5WLTN0BJZwX536MGqLnXK1iTYUJqTxg2mVTjf2JXnrqv9BuscM',
                'created_at' => '2018-09-19 13:45:27',
                'updated_at' => '2018-09-20 12:57:11',
                'activated' => 1,
                'stripe_id' => 'cus_DdN4eV3jCWcWrN',
                'card_brand' => 'Visa',
                'card_last_four' => '4242',
                'trial_ends_at' => null,
                'deleted_at' => null,
                'provider' => null,
                'provider_id' => null,
                ),
                2 =>
                array (
                'id' => 3,
                'role_id' => 3,
                'name' => 'Normal User',
                'email' => 'user@user.com',
                'avatar' => 'users/September2018/CFa4yxb3YfCX2FryUdGz.png',
                'password' => Hash::make('password'),
                'application_id' => null,
                'remember_token' => 'szr9aXigZ20JiTZWqIaBblC6U2qnx2TNCnMSliJHtN1vP8NRBb0OgZqAghMA',
                'created_at' => '2018-09-19 18:56:59',
                'updated_at' => '2018-09-19 18:56:59',
                'activated' => 0,
                'stripe_id' => null,
                'card_brand' => null,
                'card_last_four' => null,
                'trial_ends_at' => null,
                'deleted_at' => null,
                'provider' => null,
                'provider_id' => null,
                ),
                3 =>
                array (
                'id' => 4,
                'role_id' => 1,
                'name' => 'Content User',
                'email' => 'content@content.com',
                'avatar' => 'users/September2018/HkxhQr3ESLHXCTCEGibY.png',
                'password' => Hash::make('greatcontent123'),
                'application_id' => null,
                'remember_token' => 'xuA69jqONwX9XOCxehIoZoQOsKgYLEP1sVWtZyBZffJdct8mTgp144Kvtwc5',
                'created_at' => '2018-09-16 16:11:09',
                'updated_at' => '2018-09-19 19:06:23',
                'activated' => 0,
                'stripe_id' => null,
                'card_brand' => null,
                'card_last_four' => null,
                'trial_ends_at' => null,
                'deleted_at' => null,
                'provider' => null,
                'provider_id' => null,
                ),
                )
            );
        }

    }
}
