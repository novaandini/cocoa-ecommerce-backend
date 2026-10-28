<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = [
            [
                'id' => '1',
                'name' => 'Admin Kakao Nova',
                'email' => 'andininovaaa@gmail.com',
                'phone_number' => '081234560000',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'id' => '2',
                'name' => 'Admin Kakao Fika',
                'email' => 'refikalaksmi@gmail.com',
                'phone_number' => '081234560001',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'id' => '3',
                'name' => 'Admin Kakao Indah',
                'email' => 'indahaprilia@gmail.com',
                'phone_number' => '081234560002',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'id' => '4',
                'name' => 'Admin Kakao Sri',
                'email' => 'srisudiastini@gmail.com',
                'phone_number' => '081234560003',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'id' => '5',
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'phone_number' => '081234560001',
                'role' => 'customer',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'id' => '6',
                'name' => 'Sari Dewi',
                'email' => 'sari.dewi@example.com',
                'phone_number' => '081234560002',
                'role' => 'customer',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'id' => '7',
                'name' => 'Andi Pratama',
                'email' => 'andi.pratama@example.com',
                'phone_number' => '081234560003',
                'role' => 'customer',
                'password' => Hash::make('password'),
                'is_active' => false,
            ],
            [
                'id' => '8',
                'name' => 'Made Adnyana',
                'email' => 'made.adnyana@example.com',
                'phone_number' => '081234560004',
                'role' => 'customer',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'id' => '9',
                'name' => 'Putri Maharani',
                'email' => 'putri.maharani@example.com',
                'phone_number' => '081234560005',
                'role' => 'customer',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'id' => '10',
                'name' => 'Agus Setiawan',
                'email' => 'agus.setiawan@example.com',
                'phone_number' => '081234560006',
                'role' => 'customer',
                'password' => Hash::make('password'),
                'is_active' => false,
            ],
            [
                'id' => '11',
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@example.com',
                'phone_number' => '081234560007',
                'role' => 'customer',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'id' => '12',
                'name' => 'Komang Wirawan',
                'email' => 'komang.wirawan@example.com',
                'phone_number' => '081234560008',
                'role' => 'customer',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'id' => '13',
                'name' => 'Rina Anggraini',
                'email' => 'rina.anggraini@example.com',
                'phone_number' => '081234560009',
                'role' => 'customer',
                'password' => Hash::make('password'),
                'is_active' => false,
            ],
            [
                'id' => '14',
                'name' => 'Kadek Saputra',
                'email' => 'kadek.saputra@example.com',
                'phone_number' => '081234560010',
                'role' => 'customer',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'id' => '15',
                'name' => 'Admin Kakao',
                'email' => 'admin.kakao@example.com',
                'phone_number' => '081234560011',
                'role' => 'customer',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'id' => '16',
                'name' => 'Yoga Permana',
                'email' => 'yoga.permana@example.com',
                'phone_number' => '081234560012',
                'role' => 'customer',
                'password' => Hash::make('password'),
                'is_active' => false,
            ],
        ];

        foreach ($accounts as $account) {
            User::create([
                'id' => $account['id'],
                'name' => $account['name'],
                'email' => $account['email'],
                'phone_number' => $account['phone_number'],
                'role' => $account['role'],
                'password' => $account['password'],
                'is_active' => $account['is_active'],
            ]);
        }
    }
}
