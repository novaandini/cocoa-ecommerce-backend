<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $histories = [
            [1, 1, null, 'delivered', 'Order delivered successfully.'],
            [2, 2, null, 'shipped', 'Order handed over to the courier.'],
            [3, 3, null, 'shipped', 'Order shipped after payment verification.'],
            [4, 4, null, 'processing', 'Order is being prepared for shipment.'],
            [5, 5, null, 'delivered', 'Order delivered successfully.'],
            [6, 1, null, 'shipped', 'Order handed over to the courier.'],
            [7, 2, null, 'shipped', 'Order shipped after payment verification.'],
            [8, 3, null, 'processing', 'Order is being prepared for shipment.'],
            [9, 4, null, 'cancelled', 'Order cancelled after payment processing.'],
            [10, 1, null, 'delivered', 'Order delivered successfully.'],
            [11, 2, null, 'shipped', 'Order handed over to the courier.'],
            [12, 3, null, 'submitted', 'Order submitted and awaiting processing.'],
        ];

        $histories = array_map(static function (array $history): array {
            return [
                'id' => $history[0],
                'order_id' => $history[0],
                'changed_by' => $history[1],
                'previous_status' => $history[2],
                'new_status' => $history[3],
                'notes' => $history[4],
                'changed_at' => sprintf('2026-10-%02d 09:00:00', $history[0]),
            ];
        }, $histories);

        DB::table('order_status_histories')->insert($histories);
    }
}
