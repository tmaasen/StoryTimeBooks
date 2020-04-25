<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_order_id');
            $table->foreign('user_order_id')->references('user_id')->on('orders');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('customer_shopping_cart');
            $table->unsignedInteger('quantity_ordered');
            // $table->foreign('quantity_ordered')->references('quantity')->on('customer_shopping_cart');
            $table->decimal('product_total', 8, 2);
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
        Schema::dropIfExists('order_item');
    }
}
