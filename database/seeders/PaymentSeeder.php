<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $invoices = Invoice::where('status', 'paid')->get();
        
        if ($invoices->isEmpty()) {
            $this->command->warn('No paid invoices found. Please run InvoiceSeeder first.');
            return;
        }

        $methods = ['bank_transfer', 'cash', 'credit_card', 'e_wallet'];
        $payments = [];

        foreach ($invoices as $invoice) {
            // Create 1 payment for full amount
            $issueDate = \Carbon\Carbon::parse($invoice->issue_date);
            $payments[] = [
                'id' => \Illuminate\Support\Str::uuid(),
                'invoice_id' => $invoice->id,
                'payment_date' => $issueDate->addDays(rand(1, 5)),
                'amount' => $invoice->total,
                'method' => $methods[array_rand($methods)],
                'proof_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('payments')->insert($payments);

        $this->command->info('Payments seeded successfully!');
    }
}
