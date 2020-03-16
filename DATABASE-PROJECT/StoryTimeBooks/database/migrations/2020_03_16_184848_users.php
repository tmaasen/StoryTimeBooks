<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', 
            function (Blueprint $table) {
                $table->increments('CustID');
                $table->string('FirstName');
                $table->string('LastName');
                $table->string('Email')->unique();
                $table->string('PasswordHash');
                $table->boolean('IsAdmin')->default('0'); // 1 will be admin
                $table->boolean('IsDeleted')->default('0'); // Change to 1 when account is removed
                $table->rememberToken(); // This column will be used to store a token for "remember me" 
                //sessions being maintained by your application
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
        Schema::dropIfExists('users');
    }
}
