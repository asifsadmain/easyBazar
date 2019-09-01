<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('name');
            $table->string('brand')->nullable();
            $table->integer('category_id')->unsigned()->index();
            $table->string('condition');
            $table->year('buying_year')->nullable();
            $table->mediumText('specification');
            $table->integer('quantity');
            $table->string('color')->nullable();
            $table->string('weight')->nullable();
            $table->string('size')->nullable();
            $table->integer('guarantee')->nullable();
            $table->integer('warranty')->nullable();
            $table->string('display_image');
            $table->string('img1')->nullable();
            $table->string('img2')->nullable();
            $table->string('img3')->nullable();
            $table->string('img4')->nullable();
            $table->integer('rating')->default(0);
            $table->integer('rated_by')->default(0);
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
