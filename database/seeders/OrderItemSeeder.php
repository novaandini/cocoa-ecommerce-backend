<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [1, 1, 1, 1, 16.667, 150000, 2500000],
            [2, 2, 2, 2, 12, 150000, 1800000],
            [3, 3, 3, 3, 21.333, 150000, 3200000],
            [4, 4, 4, 4, 8, 150000, 1200000],
            [5, 5, 5, 5, 30, 150000, 4500000],
            [6, 6, 6, 6, 14, 150000, 2100000],
            [7, 7, 7, 7, 33.333, 150000, 5000000],
            [8, 8, 8, 8, 10, 150000, 1500000],
            [9, 9, 1, 1, 18.333, 150000, 2750000],
            [10, 10, 2, 2, 24, 150000, 3600000],
            [11, 11, 3, 3, 12.667, 150000, 1900000],
            [12, 12, 1, 1, 6.333, 150000, 950000],
        ];

        $items = array_map(static function (array $item): array {
            $createdAt = sprintf('2026-10-%02d 07:30:00', $item[0]);

            return [
                'id' => $item[0],
                'order_id' => $item[1],
                'product_id' => $item[2],
                'batch_id' => $item[3],
                'quantity_kg' => $item[4],
                'price_per_kg' => $item[5],
                'subtotal' => $item[6],
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }, $items);

        DB::table('order_items')->insert($items);
    }
}
