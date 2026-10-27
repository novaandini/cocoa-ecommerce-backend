<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movements = [
            [1, 1, null, 1, 'in', 1000, 'Initial stock received from producer.'],
            [2, 2, null, 2, 'in', 900, 'Initial stock received from producer.'],
            [3, 3, null, 3, 'in', 800, 'Initial stock received from producer.'],
            [4, 4, null, 4, 'in', 750, 'Initial stock received from producer.'],
            [5, 5, null, 1, 'in', 700, 'Initial stock received from producer.'],
            [6, 6, null, 2, 'in', 650, 'Initial stock received from producer.'],
            [7, 7, null, 3, 'in', 600, 'Initial stock received from producer.'],
            [8, 8, null, 4, 'in', 550, 'Initial stock received from producer.'],
            [9, 1, 1, 1, 'out', 16.667, 'Stock allocated to order ORD001.'],
            [10, 2, 2, 2, 'out', 12, 'Stock allocated to order ORD002.'],
            [11, 3, 3, 3, 'out', 21.333, 'Stock allocated to order ORD003.'],
            [12, 4, 4, 4, 'out', 8, 'Stock allocated to order ORD004.'],
            [13, 5, 5, 1, 'out', 30, 'Stock allocated to order ORD005.'],
            [14, 6, 6, 2, 'out', 14, 'Stock allocated to order ORD006.'],
            [15, 7, 7, 3, 'out', 33.333, 'Stock allocated to order ORD007.'],
            [16, 8, 8, 4, 'out', 10, 'Stock allocated to order ORD008.'],
            [17, 1, 9, 1, 'out', 18.333, 'Stock allocated to order ORD009.'],
            [18, 2, 10, 2, 'out', 24, 'Stock allocated to order ORD010.'],
            [19, 3, 11, 3, 'out', 12.667, 'Stock allocated to order ORD011.'],
            [20, 1, 12, 4, 'out', 6.333, 'Stock allocated to order ORD012.'],
        ];

        $movements = array_map(static function (array $movement): array {
            return [
                'id' => $movement[0],
                'batch_id' => $movement[1],
                'order_id' => $movement[2],
                'recorded_by' => $movement[3],
                'movement_type' => $movement[4],
                'quantity_kg' => $movement[5],
                'notes' => $movement[6],
                'created_at' => sprintf('2026-10-%02d 08:00:00', min($movement[0], 12)),
            ];
        }, $movements);

        DB::table('stock_movements')->insert($movements);
    }
}
