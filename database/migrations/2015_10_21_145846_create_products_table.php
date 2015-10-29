<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('skill_id')->unsigned();
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');

            $table->integer('shop_id')->unsigned();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->string('name');
            $table->float('price');
            $table->float('discount')->default(0);
            $table->float('weight')->default(0);
            $table->string('guarantee')->nullabale();
            $table->string('warranty')->nullabale();
            $table->text('description')->nullable();
            $table->integer('status')->unsigned()->default(1);
            $table->integer('rate')->unsigned()->default(0);
            $table->integer('num_visit')->unsigned()->default(0);
            $table->integer('num_buy')->unsigned()->default(0);
            $table->integer('num_comment')->unsigned()->default(0);
            $table->boolean('available');
            $table->timestamps();
        });

        Schema::create('product_tag', function (Blueprint $table) {
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('attribute_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->string('type',50);
            $table->timestamps();
        });


        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->integer('attribute_group_id')->unsigned();
            $table->foreign('attribute_group_id')->references('id')->on('attribute_groups')->onDelete('cascade');

            $table->string('value');
            $table->float('add_price')->default(0);
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
        Schema::drop('attributes');
        Schema::drop('attribute_groups');
        Schema::drop('product_tag');
        Schema::drop('products');
    }
}
