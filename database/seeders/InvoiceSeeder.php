<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::first();

        Invoice::create([
            'invoice_number' => 'INV-2026-0001',
            'created_by' => $admin->id,
            'amount' => 150000,
            'description' => 'Pembayaran UKT Semester Ganjil',
            'status' => 'unpaid',
            'due_date' => now()->addDays(7),
        ]);
    }
}
