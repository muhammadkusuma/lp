<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceItemSeeder extends Seeder
{
    public function run(): void
    {
        $invoices = Invoice::all();
        
        if ($invoices->isEmpty()) {
            $this->command->warn('No invoices found. Please run InvoiceSeeder first.');
            return;
        }

        $items = [];

        foreach ($invoices as $invoice) {
            // Add 2-4 items per invoice
            $itemCount = rand(2, 4);
            
            for ($i = 1; $i <= $itemCount; $i++) {
                $qty = rand(1, 5);
                $price = rand(5000000, 25000000);
                
                $items[] = [
                    'id' => \Illuminate\Support\Str::uuid(),
                    'invoice_id' => $invoice->id,
                    'description' => $this->getRandomDescription($i),
                    'qty' => $qty,
                    'price' => $price,
                    'total' => $qty * $price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('invoice_items')->insert($items);

        $this->command->info('Invoice items seeded successfully!');
    }

    private function getRandomDescription($index): string
    {
        $descriptions = [
            'Desain UI/UX',
            'Frontend Development',
            'Backend Development',
            'Database Design',
            'API Integration',
            'Testing & QA',
            'Deployment & Hosting',
            'Maintenance & Support',
            'Training & Documentation',
            'Project Management',
        ];

        return $descriptions[array_rand($descriptions)];
    }
}
