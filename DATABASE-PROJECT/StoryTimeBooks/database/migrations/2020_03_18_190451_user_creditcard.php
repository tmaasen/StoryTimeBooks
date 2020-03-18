<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserCreditcard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_creditcard', 
        function (Blueprint $table) {
            $table->increments('CardID');
            $table->unsignedInteger('CustID');
            $table->foreign('CustID')->references('CustID')->on('users');
            $table->string('CardType');
            $table->string('CardNumberHash');
            $table->tinyInteger('ExpMonth');
            $table->smallInteger('ExpYear');
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
        //
        Schema::dropIfExists('user_creditcard');
    }
}
