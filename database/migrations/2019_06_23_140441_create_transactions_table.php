<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('seller_id')->unsigned()->index();
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('buyer_id')->unsigned()->index();
            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('delivery_man_id')->unsigned()->index();
            $table->foreign('delivery_man_id')->references('id')->on('delivery_men')->onDelete('cascade');
            $table->string('payment_method');
            $table->boolean('product_received')->default(false);
            $table->boolean('seller_paid')->default(false);
            $table->boolean('delivered_product')->default(false);
            $table->boolean('payment_received')->default(false);
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
        Schema::dropIfExists('transactions');
    }
}
