<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
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
            $table->string('product_name');
            $table->string('author');
            $table->unsignedInteger('publisher_id');
            $table->foreign('publisher_id')->references('id')->on('publishers');
            $table->date('copyright_date');
            $table->decimal('retail_price', 8, 2);
            $table->decimal('company_cost', 8, 2);
            $table->integer('quantity_on_hand');
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
