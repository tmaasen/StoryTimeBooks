<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomerPurchases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');            
            $table->unsignedInteger('product_purchased');
            $table->foreign('product_purchased')->references('id')->on('products');
            $table->date('date_purchased');
            $table->decimal('purchase_subtotal', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->decimal('purchase_total', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_purchases');
    }
}

