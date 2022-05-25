<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('address');
            $table->string('note');
            $table->integer('total');
            $table->bigInteger('delivery_id')->unsigned();
            $table->foreign('delivery_id')->references('id')->on('deliveries');
            $table->bigInteger('coupon_id')->unsigned()->nullable(); ;
            $table->foreign('coupon_id')->references('id')->on('coupons');
            $table->bigInteger('free_ship_id')->unsigned()->nullable(); ;
            $table->foreign('free_ship_id')->references('id')->on('free_ships');
            $table->bigInteger('payment_id')->unsigned();
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('status_payment')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
