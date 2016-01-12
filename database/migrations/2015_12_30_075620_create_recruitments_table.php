<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('group_title')->nullable();
            $table->string('job_title')->nullable();
            $table->string('job_description')->nullable();
            $table->string('job_responsibility')->nullable();
            $table->string('job_certification')->nullable();
            $table->string('job_condition')->nullable();
            $table->string('job_office')->nullable();
            $table->string('job_style')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('active')->default(0);
            $table->timestamps();
        });

        Schema::create('recruitment_tag', function (Blueprint $table) { //pivot
            $table->integer('recruitment_id')->unsigned();
            $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('cascade');
            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('recruitment_questionnaire',function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('content');
            $table->timestamps();
            
        });

        Schema::create('question_recruitment',function(Blueprint $table){ //pivot
            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('recruitment_questionnaire')->onDelete('cascade');
            $table->integer('recruitment_id')->unsigned();
            $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('cascade');
            $table->integer('required')->default(0);
            $table->timestamps();
        });

        Schema::create('recruitment_answer',function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('recruitment_questionnaire')->onDelete('cascade');
            $table->integer('recruitment_id')->unsigned();
            $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('cascade');
            $table->string('content');
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
        Schema::drop('recruitment_answer');
        Schema::drop('question_recruitment');
        Schema::drop('recruitment_questionnaire');
        Schema::drop('recruitment_tag');
        Schema::drop('recruitments');
    }
}
