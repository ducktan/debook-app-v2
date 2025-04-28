
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Thêm cột 'status' vào bảng 'user_subscriptions'
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->enum('status', ['active', 'expired', 'cancelled'])->default('active'); // Đảm bảo enum được định nghĩa đúng
        });
    }

    public function down()
    {
        // Xóa cột 'status' nếu cần rollback migration
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
