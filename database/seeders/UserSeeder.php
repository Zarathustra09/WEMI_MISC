<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'first_name' => 'Joshua',
            'middle_name' => null,
            'last_name' => 'Pardo',
            'email' => 'joshua.pardo30@gmail.com',
            'role' => 1,
            'password' => Hash::make('Wemi@123'),
        ]);

        User::create([
            'first_name' => 'Zara',
            'middle_name' => null,
            'last_name' => 'Theal',
            'email' => 'zaratheal@gmail.com',
            'role' => 2,
            'password' => Hash::make('Wemi@12345'),
        ]);
    }
}
