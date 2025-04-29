<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('image');
            $table->enum('format_type', ['ebook', 'audiobook', 'podcast', 'blog']);
            $table->decimal('rating', 2, 1)->default(0);
            $table->unsignedBigInteger('category_id');
            $table->integer('sales_count')->default(0);
            $table->timestamps();

            // Thêm khóa ngoại sau khi tạo bảng
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};