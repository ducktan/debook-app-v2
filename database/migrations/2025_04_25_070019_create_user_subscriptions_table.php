<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subscription_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'expired', 'cancelled'])->default('active');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');


             // Chỉ thêm cột nếu nó chưa tồn tại
             if (!Schema::hasColumn('user_subscriptions', 'status')) {
                $table->enum('status', ['active', 'expired', 'cancelled'])->default('active');
            }
        });



     
    }



    public function down()
    {
        Schema::dropIfExists('user_subscriptions');
    }


}