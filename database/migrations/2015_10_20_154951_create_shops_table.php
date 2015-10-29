<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('logo',50)->nullable();
            $table->string('phone',50)->nullable();
            $table->string('address')->nullable();
            $table->string('theme',50)->default('danger');
            $table->integer('num_visit')->unsigned()->default(0);
            $table->integer('num_buy')->unsigned()->default(0);
            $table->integer('rate')->unsigned()->default(0);
            $table->text('description')->nullable();
            $table->longText('about_us')->nullable();
            $table->longText('contact_us')->nullable();
            $table->integer('status')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('advantages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('logo',50)->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->unsigned()->default(1);
            $table->timestamps();
        });

        Schema::create('advantage_shop', function (Blueprint $table) {
            $table->integer('advantage_id')->unsigned()->index();
            $table->foreign('advantage_id')->references('id')->on('advantages')->onDelete('cascade');

            $table->integer('shop_id')->unsigned()->index();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');

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
        Schema::drop('advantage_shop');
        Schema::drop('advantages');
        Schema::drop('shops');
    }
}
