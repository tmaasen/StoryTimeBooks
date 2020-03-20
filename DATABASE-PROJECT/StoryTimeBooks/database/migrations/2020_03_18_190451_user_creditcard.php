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
            $table->increments('CardID');//added to model
            $table->unsignedInteger('CustID');
            $table->foreign('CustID')->references('CustID')->on('users');
            $table->string('CardType');//added to model
            $table->string('CardNumberHash');//added to model
            $table->tinyInteger('ExpMonth');//added to model
            $table->smallInteger('ExpYear');//added to model
            $table->timestamps();//added to model
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
