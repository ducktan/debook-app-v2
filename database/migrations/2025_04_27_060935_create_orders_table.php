<?php

// database/migrations/xxxx_xx_xx_create_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // người mua
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // sản phẩm mua
            $table->integer('quantity')->default(1); // số lượng
            $table->integer('total_price'); // tổng tiền
            $table->string('status')->default('pending'); // trạng thái: pending/paid/canceled
            $table->timestamps(); // created_at + updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

