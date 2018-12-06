<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
          $table->increments('id');
          $table->string('post_id');
          $table->string('user_id');
          $table->string('title');
          $table->string('fileType');
          $table->string('tags');
          $table->string('codeType');
          $table->string('image');
          $table->mediumText('texta');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
