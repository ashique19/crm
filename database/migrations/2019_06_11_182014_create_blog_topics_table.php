<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('blog_topics')) {
            Schema::create(
                'blog_topics', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('topic');
                    $table->unsignedInteger('used')->default('0');
                    $table->boolean('status')->default('0');
                    $table->timestamp('last_request')->nullable();
                }
            );
        }
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_topics');
    }
}
