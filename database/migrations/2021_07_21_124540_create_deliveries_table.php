<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tp_id')->unsigned();
            $table->foreign('tp_id')->references('id')->on('cities');
            $table->bigInteger('qh_id')->unsigned();
            $table->foreign('qh_id')->references('id')->on('provinces');
            $table->bigInteger('xa_id')->unsigned();
            $table->foreign('xa_id')->references('id')->on('communes');
            $table->integer('price');
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
        Schema::dropIfExists('deliveries');
    }
}
