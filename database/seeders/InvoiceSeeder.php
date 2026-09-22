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
        $finance = User::where('role', 'finance')->first();
        $payer = User::where('role', 'payer')->first();

        Invoice::create([
            'invoice_number' => 'INV-2026-0001',
            'payer_id' => $payer->id,
            'created_by' => $finance->id,
            'amount' => 150000,
            'description' => 'Pembayaran Tagihan bulanan',
            'status' => 'unpaid',
            'due_date' => now()->addDays(7),
        ]);
    }
}
