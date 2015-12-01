<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporationQuestionnaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporation_questionnaire', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->timestamps();
        });

        Schema::create('corporation_answer',function(Blueprint $table){
            $table->increments('id');
            $table->integer('corporation_id')->unsigned();
            $table->foreign('corporation_id')->references('id')->on('corporations')->onDelete('cascade');
            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('corporation_questionnaire')->onDelete('cascade');
            $table->integer('answer');
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
        Schema::drop('corporation_answer');
        Schema::drop('corporation_questionnaire');
    }
}
