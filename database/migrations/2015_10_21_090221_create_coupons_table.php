<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('offer_id')->unsigned();
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
            $table->integer('coupon_gallery_id')->unsigned();
            $table->foreign('coupon_gallery_id')->references('id')->on('coupon_gallery')->onDelete('cascade');
            $table->float('real_amount');
            $table->float('pay_amount');
            $table->string('title');
            $table->string('description');
            $table->integer('num')->unsigned();
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
        Schema::drop('coupons');
    }
}
