<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title')->nullable();
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

        Schema::create('questionnaire_tag', function (Blueprint $table) {
            $table->integer('questionnaire_id')->unsigned()->index();
            $table->foreign('questionnaire_id')->references('id')->on('questionnaires')->onDelete('cascade');

            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('questionnaire_id')->unsigned();
            $table->string('title');
            $table->timestamps();

            $table->foreign('questionnaire_id')->references('id')->on('questionnaires')->onDelete('cascade');
        });

        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->string('name');
            $table->integer('num_vote')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });

        Schema::create('ticks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('questionnaire_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->integer('option_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('questionnaire_id')->references('id')->on('questionnaires')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ticks');
        Schema::drop('options');
        Schema::drop('questions');
        Schema::drop('questionnaire_tag');
        Schema::drop('questionnaires');
    }
}
