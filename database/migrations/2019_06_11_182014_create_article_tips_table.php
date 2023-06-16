<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateArticleTipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('article_tips')) {
            Schema::create(
                'article_tips', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('category');
                    $table->text('tip');
                    $table->integer('used')->default(0);
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
        Schema::dropIfExists('article_tips');
    }
}
