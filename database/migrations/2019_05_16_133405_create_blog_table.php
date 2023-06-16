<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'blog', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('title');
                $table->text('content');  
                $table->string('image');                
                $table->string('slug');
                $table->text('meta_keywords')->nullable();
                $table->text('meta_description')->nullable();
                $table->integer('views');   
                $table->integer('link_built')->default(0);                    
                $table->integer('status');                
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
        Schema::drop('blog');
    }
}
