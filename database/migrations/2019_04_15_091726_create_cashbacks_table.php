<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashbacks', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';
            $table->increments('id');
            $table->integer('user_id')->length(10)->unsigned();
            $table->integer('transaction_id')->length(10)->unsigned();
            $table->integer('voucher_id')->length(10)->unsigned();
            $table->integer('cashback');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('voucher_id')->references('id')->on('vouchers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashbacks');
    }
}
