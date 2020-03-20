<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_address', 
            function (Blueprint $table) {
                $table->increments('AddressID'); //added to model
                $table->unsignedInteger('CustID');
                $table->foreign('CustID')->references('CustID')->on('users');
                $table->string('AddressLine1'); //added to model
                $table->string('SuiteNo');  //added to model
                $table->string('City'); //added to model
                $table->unsignedInteger('StateID');
                if (Schema::hasTable('state')) {
                $table->foreign('StateID')->references('StateID')->on('state');
                }
                $table->string('RowGuid');      //added to model
                $table->string('HomePhone');    //added to model
                $table->string('WorkPhone');    //added to model
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_address');
    }
}
