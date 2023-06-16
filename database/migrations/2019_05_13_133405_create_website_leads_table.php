<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'website_leads', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('website_id');
                $table->integer('user_id')->nullable();
                $table->string('first_name')->nullable();  
                $table->string('last_name')->nullable();                  
                $table->string('email')->nullable();                    
                $table->string('phone')->nullable();                        
                $table->text('notes')->nullable();
                $table->string('conversion_point')->nullable();
                $table->integer('status')->default(0);                
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
        Schema::drop('website_leads');
    }
}
