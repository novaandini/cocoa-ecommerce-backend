<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'id' => '1',
                'product_code' => 'P001',
                'product_name' => 'Cocoa Bean A',
                'product_type' => 'fermented',
                'grade' => 'A',
                'price_per_kg' => 150000,
                'is_active' => true,
                'image_url' => '../home/cocoa-bean-a.jpg',
                'description' => 'Biji kakao fermentasi Grade A untuk kebutuhan pengolahan kakao.',
            ],

            [
                'id' => '2',
                'product_code' => 'P002',
                'product_name' => 'Cocoa Bean B',
                'product_type' => 'fermented',
                'grade' => 'B',
                'price_per_kg' => 150000,
                'is_active' => true,
                'image_url' => '../home/cocoa-bean-b.jpg',
                'description' => 'Biji kakao fermentasi Grade B dengan stok yang tersedia.',
            ],

            [
                'id' => '3',
                'product_code' => 'P003',
                'product_name' => 'Cocoa Bean C',
                'product_type' => 'non_fermented',
                'grade' => 'C',
                'price_per_kg' => 150000,
                'is_active' => true,
                'image_url' => '../home/cocoa-bean-c.jpg',
                'description' => 'Biji kakao non-fermentasi untuk kebutuhan produk kakao.',
            ],

            [
                'id' => '4',
                'product_code' => 'P004',
                'product_name' => 'Cocoa Bean D',
                'product_type' => 'fermented',
                'grade' => 'A',
                'price_per_kg' => 150000,
                'is_active' => true,
                'image_url' => '../home/cocoa-bean-d.jpg',
                'description' => 'Biji kakao fermentasi Grade A dengan ketersediaan stok 650 kg.',
            ],

            [
                'id' => '5',
                'product_code' => 'P005',
                'product_name' => 'Cocoa Bean E',
                'product_type' => 'fermented',
                'grade' => 'B',
                'price_per_kg' => 150000,
                'is_active' => true,
                'image_url' => '../home/cocoa-bean-e.jpg',
                'description' => 'Biji kakao fermentasi Grade B dengan ketersediaan stok 450 kg.',
            ],

            [
                'id' => '6',
                'product_code' => 'P006',
                'product_name' => 'Cocoa Bean F',
                'product_type' => 'non_fermented',
                'grade' => 'B',
                'price_per_kg' => 150000,
                'is_active' => true,
                'image_url' => '../home/cocoa-bean-f.png',
                'description' => 'Biji kakao non-fermentasi Grade B dengan stok 700 kg.',
            ],

            [
                'id' => '7',
                'product_code' => 'P007',
                'product_name' => 'Cocoa Bean G',
                'product_type' => 'fermented',
                'grade' => 'C',
                'price_per_kg' => 150000,
                'is_active' => true,
                'image_url' => '../home/cocoa-bean-g.jpg',
                'description' => 'Biji kakao fermentasi Grade C dengan ketersediaan stok 350 kg.',
            ],

            [
                'id' => '8',
                'product_code' => 'P008',
                'product_name' => 'Cocoa Bean H',
                'product_type' => 'non_fermented',
                'grade' => 'A',
                'price_per_kg' => 150000,
                'is_active' => true,
                'image_url' => '../home/cocoa-bean-h.jpg',
                'description' => 'Biji kakao non-fermentasi Grade A dengan stok 550 kg.',
            ],

        ];

        foreach ($products as $product) {
            Product::create([
                'id' => $product['id'],
                'product_code' => $product['product_code'],
                'product_name' => $product['product_name'],
                'product_type' => $product['product_type'],
                'grade' => $product['grade'],
                'price_per_kg' => $product['price_per_kg'],
                'image_url' => $product['image_url'],
                'is_active' => $product['is_active'],
                'image_url' => $product['image_url'],
                'description' => $product['description'],
            ]);
        }
    }
}
