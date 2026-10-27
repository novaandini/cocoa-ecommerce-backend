<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shipments = [
            [1, 'JNE', 'JNE202610140001', 'Denpasar, Bali', 'delivered', '2026-10-01 08:00:00', '2026-10-03 18:00:00', '2026-10-03 14:00:00', 'Service REG. Origin: Jembrana, Bali. Weight: 10 kg.'],
            [2, 'JNE', 'JNE202610140002', 'Surabaya, Jawa Timur', 'in_transit', '2026-10-12 08:00:00', '2026-10-14 18:00:00', null, 'Service YES. Origin: Jembrana, Bali. Weight: 15 kg.'],
            [3, 'JNE', 'JNE202610140003', 'Jakarta Selatan, DKI Jakarta', 'shipped', '2026-10-13 08:00:00', '2026-10-17 18:00:00', null, 'Service REG. Origin: Jembrana, Bali. Weight: 20 kg.'],
            [4, 'JNE', 'JNE202610140004', 'Bandung, Jawa Barat', 'packed', null, null, null, 'Service REG. Origin: Jembrana, Bali. Weight: 12 kg.'],
            [5, 'JNE', 'JNE202610140005', 'Yogyakarta, DI Yogyakarta', 'delivered', '2026-10-08 08:00:00', '2026-10-09 18:00:00', '2026-10-09 15:00:00', 'Service YES. Origin: Jembrana, Bali. Weight: 8 kg.'],
            [6, 'JNE', 'JNE202610140006', 'Malang, Jawa Timur', 'in_transit', '2026-10-13 08:00:00', '2026-10-16 18:00:00', null, 'Service REG. Origin: Jembrana, Bali. Weight: 18 kg.'],
            [7, 'JNE', 'JNE202610140007', 'Makassar, Sulawesi Selatan', 'shipped', '2026-10-12 08:00:00', '2026-10-18 18:00:00', null, 'Service REG. Origin: Jembrana, Bali. Weight: 25 kg.'],
            [8, 'JNE', 'JNE202610140008', 'Gianyar, Bali', 'packed', null, null, null, 'Service JTR. Origin: Jembrana, Bali. Weight: 100 kg.'],
            [9, 'JNE', 'JNE202610140009', 'Semarang, Jawa Tengah', 'failed', null, null, null, 'Service REG. Origin: Jembrana, Bali. Weight: 16 kg. Shipment cancelled.'],
            [10, 'JNE', 'JNE202610140010', 'Denpasar, Bali', 'delivered', '2026-10-10 08:00:00', '2026-10-12 18:00:00', '2026-10-12 14:00:00', 'Service REG. Origin: Jembrana, Bali. Weight: 5 kg.'],
            [11, 'JNE', 'JNE202610140011', 'Tangerang, Banten', 'in_transit', '2026-10-13 08:00:00', '2026-10-15 18:00:00', null, 'Service YES. Origin: Jembrana, Bali. Weight: 22 kg.'],
            [12, 'JNE', 'JNE202610140012', 'Denpasar, Bali', 'pending', null, null, null, 'Service REG. Origin: Jembrana, Bali. Weight: 10 kg.'],
        ];

        $shipments = array_map(static function (array $shipment): array {
            return [
                'order_id' => $shipment[0],
                'courier_name' => $shipment[1],
                'tracking_number' => $shipment[2],
                'shipping_address' => $shipment[3],
                'shipment_status' => $shipment[4],
                'shipped_at' => $shipment[5],
                'estimated_arrival' => $shipment[6],
                'delivered_at' => $shipment[7],
                'notes' => $shipment[8],
            ];
        }, $shipments);

        DB::table('shipments')->insert($shipments);
    }
}
