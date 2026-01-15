<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::all();
        $services = Service::all();
        
        if ($clients->isEmpty()) {
            $this->command->warn('No clients found. Please run ClientSeeder first.');
            return;
        }

        if ($services->isEmpty()) {
            $this->command->warn('No services found. Please run ServiceSeeder first.');
            return;
        }

        $projects = [
            [
                'client_id' => $clients->random()->id,
                'service_id' => $services->random()->id,
                'name' => 'Website Company Profile',
                'start_date' => now()->subMonths(3),
                'end_date' => now()->subMonths(1),
                'status' => 'done',
                'value' => 15000000,
            ],
            [
                'client_id' => $clients->random()->id,
                'service_id' => $services->random()->id,
                'name' => 'Aplikasi Mobile E-Commerce',
                'start_date' => now()->subMonths(2),
                'end_date' => now()->addMonth(),
                'status' => 'running',
                'value' => 75000000,
            ],
            [
                'client_id' => $clients->random()->id,
                'service_id' => $services->random()->id,
                'name' => 'Sistem Manajemen Inventory',
                'start_date' => now()->subMonths(4),
                'end_date' => now()->subMonths(2),
                'status' => 'done',
                'value' => 35000000,
            ],
            [
                'client_id' => $clients->random()->id,
                'service_id' => $services->random()->id,
                'name' => 'Dashboard Analytics',
                'start_date' => now()->subMonth(),
                'end_date' => now()->addMonths(2),
                'status' => 'running',
                'value' => 45000000,
            ],
            [
                'client_id' => $clients->random()->id,
                'service_id' => $services->random()->id,
                'name' => 'API Integration System',
                'start_date' => now(),
                'end_date' => null,
                'status' => 'planning',
                'value' => 25000000,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        $this->command->info('Projects seeded successfully!');
    }
}
