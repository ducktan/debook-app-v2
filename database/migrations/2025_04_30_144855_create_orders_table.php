<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // nullable nếu khách không login
            $table->string('codeVNPAY')->unique(); // mã đơn (VD: vnp_TxnRef)
            $table->string('status')->default('pending'); // pending | paid | failed
            $table->integer('total'); // tổng tiền (VND)
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
