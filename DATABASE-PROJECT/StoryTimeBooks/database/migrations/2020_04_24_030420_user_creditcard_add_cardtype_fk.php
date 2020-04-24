<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserCreditcardAddCardtypeFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_creditcard', function (Blueprint $table) {
            // $table->dropColumn('card_type');
            $table->renameColumn('card_type','card_id');
            $table->unsignedInteger('card_id');
            $table->foreign('card_id')->references('id')->on('creditcard_types');
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
    }
}
