<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageReviewProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_review_products', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->bigInteger('review_product_id')->unsigned();
            $table->foreign('review_product_id')->references('id')->on('review_products');
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
        Schema::dropIfExists('image_review_products');
    }
}
