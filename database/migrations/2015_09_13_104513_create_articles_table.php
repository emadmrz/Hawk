<?php

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
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->string('banner');
            $table->longText('content');
            $table->string('keywords');
            $table->integer('num_like')->unsigned()->default(0);
            $table->integer('num_comment')->unsigned()->default(0);
            $table->integer('num_visit')->unsigned()->default(0);
            $table->boolean('status');
            $table->integer('active')->default(1);
            $table->boolean('is_published');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
