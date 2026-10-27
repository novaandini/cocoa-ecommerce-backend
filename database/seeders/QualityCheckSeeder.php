<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QualityCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $qualityChecks = [
            [1, 1, 7.5, 92.5, 1.2, 'passed', 'Grade A batch passed quality inspection.', '2026-02-02 10:00:00'],
            [2, 2, 8.2, 88.4, 2.5, 'passed', 'Grade B batch passed quality inspection.', '2026-02-06 10:00:00'],
            [3, 3, 9.1, 72.5, 5.8, 'failed', 'Fermentation level below the required threshold.', '2026-02-16 10:00:00'],
            [4, 4, 6.8, 94.1, 0.9, 'passed', 'Grade A batch passed quality inspection.', '2026-02-26 10:00:00'],
            [5, 5, 8.7, 86.9, 3.1, 'pending', 'Awaiting secondary laboratory review.', null],
            [6, 6, 7.9, 81.3, 4.4, 'passed', 'Batch approved for standard processing.', '2026-03-26 10:00:00'],
            [7, 7, 10.2, 68.5, 7.2, 'failed', 'Moisture and fermentation results require remediation.', '2026-04-16 10:00:00'],
            [8, 8, 6.5, 91.8, 1.4, 'passed', 'Batch passed quality inspection.', '2026-04-26 10:00:00'],
        ];

        $qualityChecks = array_map(static function (array $check): array {
            return [
                'id' => $check[0],
                'batch_id' => $check[0],
                'checked_by' => $check[1],
                'moisture_percentage' => $check[2],
                'fermentation_percentage' => $check[3],
                'defective_beans_percentage' => $check[4],
                'quality_result' => $check[5],
                'notes' => $check[6],
                'checked_at' => $check[7],
                'created_at' => $check[7] ?? '2026-04-26 10:00:00',
                'updated_at' => $check[7] ?? '2026-04-26 10:00:00',
            ];
        }, $qualityChecks);

        DB::table('quality_checks')->insert($qualityChecks);
    }
}
