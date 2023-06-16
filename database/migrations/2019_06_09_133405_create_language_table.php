<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'language', function (Blueprint $table) {
                $table->increments('id');
                $table->string('key');
                $table->string('value'); 
            }
        );
        
        \DB::statement("UPDATE settings SET `key` = 'site.contact_form_email', `display_name` = 'Contact Form Email', `value`='contact@domain.com' WHERE `key` = 'site.logo'");
        
        \DB::table('language')->insert(
            array (
            0 => 
            array (
            'id' => 1,
            'key' => 'client_type_name',
            'value' => 'Barbers',
            ),    
            )
        );
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('language');
    }
}
