<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Keuangan',
            'email' => 'finance@example.com',
            'password' => Hash::make('password'),
            'role' => 'finance',
            'identity_number' => 'FIN-001',
        ]);

        User::create([
            'name' => 'Budi',
            'email' => 'budi@example.com',
            'password' => Hash::make('password'),
            'role' => 'payer',
            'identity_number' => '12345678',
        ]);
    }
}
