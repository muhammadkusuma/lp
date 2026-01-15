<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::all();
        $projects = Project::all();
        
        if ($projects->isEmpty()) {
            $this->command->warn('No projects found. Please run ProjectSeeder first.');
            return;
        }

        $invoices = [
            [
                'client_id' => $clients->random()->id,
                'project_id' => $projects->random()->id,
                'invoice_number' => 'INV-2026-001',
                'issue_date' => now()->subDays(30),
                'due_date' => now()->subDays(15),
                'subtotal' => 50000000,
                'tax' => 5500000,
                'total' => 55500000,
                'status' => 'paid',
            ],
            [
                'client_id' => $clients->random()->id,
                'project_id' => $projects->random()->id,
                'invoice_number' => 'INV-2026-002',
                'issue_date' => now()->subDays(20),
                'due_date' => now()->subDays(5),
                'subtotal' => 75000000,
                'tax' => 8250000,
                'total' => 78250000, 
                'status' => 'paid',
            ],
            [
                'client_id' => $clients->random()->id,
                'project_id' => $projects->random()->id,
                'invoice_number' => 'INV-2026-003',
                'issue_date' => now()->subDays(10),
                'due_date' => now()->addDays(5),
                'subtotal' => 35000000,
                'tax' => 3850000,
                'total' => 38850000,
                'status' => 'sent',
            ],
            [
                'client_id' => $clients->random()->id,
                'project_id' => $projects->random()->id,
                'invoice_number' => 'INV-2026-004',
                'issue_date' => now()->subDays(5),
                'due_date' => now()->addDays(10),
                'subtotal' => 45000000,
                'tax' => 4950000,
                'total' => 49950000,
                'status' => 'sent',
            ],
            [
                'client_id' => $clients->random()->id,
                'project_id' => $projects->random()->id,
                'invoice_number' => 'INV-2026-005',
                'issue_date' => now(),
                'due_date' => now()->addDays(30),
                'subtotal' => 25000000,
                'tax' => 2750000,
                'total' => 27750000,
                'status' => 'draft',
            ],
        ];

        foreach ($invoices as $invoice) {
            Invoice::create($invoice);
        }

        $this->command->info('Invoices seeded successfully!');
    }
}
