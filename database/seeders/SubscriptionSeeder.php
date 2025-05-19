<?php

// database/seeders/SubscriptionSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SubscriptionSeeder extends Seeder
{
    public function run()
    {
        DB::table('subscriptions')->insert([
            [
                'name' => 'Gói 1 tháng',
                'description' => 'Truy cập Sách Hội viên trong vòng 1 tháng.',
                'price' => 49000,
                'duration' => 1,
                'duration_unit' => 'months',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gói 3 tháng',
                'description' => 'Tiết kiệm hơn với gói 3 tháng.',
                'price' => 129000,
                'duration' => 3,
                'duration_unit' => 'months',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gói 1 năm',
                'description' => 'Tiết kiệm nhất với gói 12 tháng sử dụng không giới hạn.',
                'price' => 399000,
                'duration' => 12,
                'duration_unit' => 'months',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
