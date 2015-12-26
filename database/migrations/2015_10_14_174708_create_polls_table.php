<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('question')->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->tinyInteger('scope')->nullable();
            $table->integer('count')->unsigned();
            $table->boolean('show_result')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->unsigned()->default(0);
            $table->integer('active')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('poll_tag', function (Blueprint $table) {
            $table->integer('poll_id')->unsigned()->index();
            $table->foreign('poll_id')->references('id')->on('polls')->onDelete('cascade');

            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

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
        Schema::drop('poll_tag');
        Schema::drop('polls');
    }
}
