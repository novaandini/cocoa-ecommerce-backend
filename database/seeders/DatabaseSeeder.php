<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            CustomerSeeder::class,
            ProductSeeder::class,
            BatchSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            OrderStatusHistorySeeder::class,
            ShipmentSeeder::class,
            StockMovementSeeder::class,
            QualityCheckSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
