<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('author')->nullable();
            $table->string('type'); // Validate kiểu ebook/podcast trong code
            $table->unsignedBigInteger('category_id')->nullable();
            $table->date('publication_date')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('file_url')->nullable();
            $table->string('image_url')->nullable();
            $table->integer('duration')->nullable(); // thời lượng (phút/giây)
            $table->string('language', 50)->nullable();
            $table->float('rating')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
