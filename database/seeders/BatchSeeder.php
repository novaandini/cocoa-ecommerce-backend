<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $batches = [
            [1, 1, 'BATCH-2026-001', 'Jembrana, Bali', '2026-01-15', '2026-02-01', 1000, 928.667, 'Fermented cocoa beans Grade A.'],
            [2, 2, 'BATCH-2026-002', 'Jembrana, Bali', '2026-01-20', '2026-02-05', 900, 864, 'Fermented cocoa beans Grade B.'],
            [3, 3, 'BATCH-2026-003', 'Jembrana, Bali', '2026-02-01', '2026-02-15', 800, 766, 'Non-fermented cocoa beans Grade C.'],
            [4, 4, 'BATCH-2026-004', 'Jembrana, Bali', '2026-02-10', '2026-02-25', 750, 742, 'Fermented cocoa beans Grade A.'],
            [5, 5, 'BATCH-2026-005', 'Jembrana, Bali', '2026-03-01', '2026-03-15', 700, 670, 'Fermented cocoa beans Grade B.'],
            [6, 6, 'BATCH-2026-006', 'Jembrana, Bali', '2026-03-10', '2026-03-25', 650, 636, 'Non-fermented cocoa beans Grade B.'],
            [7, 7, 'BATCH-2026-007', 'Jembrana, Bali', '2026-04-01', '2026-04-15', 600, 566.667, 'Fermented cocoa beans Grade C.'],
            [8, 8, 'BATCH-2026-008', 'Jembrana, Bali', '2026-04-10', '2026-04-25', 550, 540, 'Non-fermented cocoa beans Grade A.'],
        ];

        $batches = array_map(static function (array $batch): array {
            return [
                'id' => $batch[0],
                'product_id' => $batch[1],
                'batch_code' => $batch[2],
                'origin' => $batch[3],
                'harvest_date' => $batch[4],
                'production_date' => $batch[5],
                'initial_quantity_kg' => $batch[6],
                'available_quantity_kg' => $batch[7],
                'notes' => $batch[8],
                'created_at' => $batch[5].' 08:00:00',
                'updated_at' => $batch[5].' 08:00:00',
            ];
        }, $batches);

        DB::table('batches')->insert($batches);
    }
}
