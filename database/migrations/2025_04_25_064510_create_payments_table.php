<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Người thanh toán
            $table->unsignedBigInteger('product_id'); // Sản phẩm đã mua
            $table->decimal('amount', 10, 2); // Số tiền
            $table->string('payment_method')->nullable(); // Ví dụ: 'paypal', 'momo', 'vnpay', 'credit_card'
            $table->string('status')->default('pending'); // 'pending', 'completed', 'failed'
            $table->string('transaction_id')->nullable(); // Mã giao dịch nếu có
            $table->timestamps();

            // Ràng buộc khoá ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}

