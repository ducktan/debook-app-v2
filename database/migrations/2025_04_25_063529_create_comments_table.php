<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // người dùng viết comment
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // sản phẩm được comment
            $table->text('content'); // nội dung bình luận
            $table->tinyInteger('rating')->default(0); // điểm đánh giá: từ 1 đến 5
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
