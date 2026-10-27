<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [1, 1, 'delivered', 'paid', 'Denpasar, Bali', 25000, 2525000, '2026-10-01 07:00:00'],
            [2, 2, 'shipped', 'paid', 'Surabaya, Jawa Timur', 45000, 1845000, '2026-10-02 07:00:00'],
            [3, 3, 'shipped', 'pending_verification', 'Jakarta Selatan, DKI Jakarta', 65000, 3265000, '2026-10-03 07:00:00'],
            [4, 4, 'processing', 'unpaid', 'Bandung, Jawa Barat', 55000, 1255000, '2026-10-04 07:00:00'],
            [5, 5, 'delivered', 'paid', 'Yogyakarta, DI Yogyakarta', 50000, 4550000, '2026-10-05 07:00:00'],
            [6, 6, 'shipped', 'unpaid', 'Malang, Jawa Timur', 40000, 2140000, '2026-10-06 07:00:00'],
            [7, 7, 'shipped', 'paid', 'Makassar, Sulawesi Selatan', 85000, 5085000, '2026-10-07 07:00:00'],
            [8, 8, 'processing', 'unpaid', 'Gianyar, Bali', 120000, 1620000, '2026-10-08 07:00:00'],
            [9, 9, 'cancelled', 'paid', 'Semarang, Jawa Tengah', 60000, 2810000, '2026-10-09 07:00:00'],
            [10, 10, 'delivered', 'pending_verification', 'Denpasar, Bali', 20000, 3620000, '2026-10-10 07:00:00'],
            [11, 11, 'shipped', 'paid', 'Tangerang, Banten', 70000, 1970000, '2026-10-11 07:00:00'],
            [12, 1, 'submitted', 'refunded', 'Denpasar, Bali', 30000, 980000, '2026-10-12 07:00:00'],
        ];

        $orders = array_map(static function (array $order): array {
            return [
                'id' => $order[0],
                'order_number' => sprintf('ORD%03d', $order[0]),
                'customer_id' => $order[1],
                'order_status' => $order[2],
                'payment_status' => $order[3],
                'shipping_address' => $order[4],
                'shipping_fee' => $order[5],
                'total_amount' => $order[6],
                'ordered_at' => $order[7],
                'created_at' => $order[7],
                'updated_at' => $order[7],
            ];
        }, $orders);

        DB::table('orders')->insert($orders);
    }
}
