<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [1, 5, 'Budi Santoso Cocoa Supply', 'Budi Santoso', '081234560001', 'Jembrana, Bali', 'NPWP-510101000001', true],
            [2, 6, 'Sari Dewi Trading', 'Sari Dewi', '081234560002', 'Jembrana, Bali', 'NPWP-510101000002', true],
            [3, 7, 'Andi Pratama Cocoa', 'Andi Pratama', '081234560003', 'Jembrana, Bali', 'NPWP-510101000003', false],
            [4, 8, 'Made Adnyana Beans', 'Made Adnyana', '081234560004', 'Jembrana, Bali', 'NPWP-510101000004', true],
            [5, 9, 'Putri Maharani Foods', 'Putri Maharani', '081234560005', 'Jembrana, Bali', 'NPWP-510101000005', true],
            [6, 10, 'Agus Setiawan Agro', 'Agus Setiawan', '081234560006', 'Jembrana, Bali', 'NPWP-510101000006', false],
            [7, 11, 'Dewi Lestari Cocoa', 'Dewi Lestari', '081234560007', 'Jembrana, Bali', 'NPWP-510101000007', true],
            [8, 12, 'Komang Wirawan Supply', 'Komang Wirawan', '081234560008', 'Jembrana, Bali', 'NPWP-510101000008', true],
            [9, 13, 'Rina Anggraini Trading', 'Rina Anggraini', '081234560009', 'Jembrana, Bali', 'NPWP-510101000009', false],
            [10, 14, 'Kadek Saputra Cocoa', 'Kadek Saputra', '081234560010', 'Jembrana, Bali', 'NPWP-510101000010', true],
            [11, 16, 'Yoga Permana Export', 'Yoga Permana', '081234560012', 'Jembrana, Bali', 'NPWP-510101000011', false],
        ];

        $customers = array_map(static function (array $customer): array {
            return [
                'id' => $customer[0],
                'user_id' => $customer[1],
                'company_name' => $customer[2],
                'pic_name' => $customer[3],
                'phone' => $customer[4],
                'address' => $customer[5],
                'tax_id' => $customer[6],
                'allow_public_company_name' => $customer[7],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $customers);

        DB::table('customers')->insert($customers);
    }
}
