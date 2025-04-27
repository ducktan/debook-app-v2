<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable(); // 👈 thêm dòng này
            $table->timestamps();
            $table->softDeletes(); // hỗ trợ xóa mềm
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
