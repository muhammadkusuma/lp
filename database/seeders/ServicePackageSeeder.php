<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicePackageSeeder extends Seeder
{
    public function run(): void
    {
        $services = Service::all();
        
        if ($services->isEmpty()) {
            $this->command->warn('No services found. Please run ServiceSeeder first.');
            return;
        }

        $packages = [];

        foreach ($services as $service) {
            // Create 3 packages per service
            $packageTypes = [
                [
                    'name' => 'Paket Basic',
                    'price' => 5000000,
                    'features' => json_encode([
                        'Konsultasi awal',
                        'Desain basic',
                        'Development',
                        'Testing',
                        'Durasi: 1 bulan',
                        'Support 1 bulan',
                    ]),
                ],
                [
                    'name' => 'Paket Professional',
                    'price' => 10000000,
                    'features' => json_encode([
                        'Konsultasi mendalam',
                        'Desain premium',
                        'Development advanced',
                        'Testing & QA',
                        'SEO optimization',
                        'Durasi: 2 bulan',
                        'Support 3 bulan',
                    ]),
                ],
                [
                    'name' => 'Paket Enterprise',
                    'price' => 20000000,
                    'features' => json_encode([
                        'Full consultation',
                        'Custom design',
                        'Advanced development',
                        'Comprehensive testing',
                        'SEO & Performance optimization',
                        'Training',
                        'Durasi: 3 bulan',
                        'Support 6 bulan',
                        'Priority support',
                    ]),
                ],
            ];

            foreach ($packageTypes as $package) {
                $packages[] = [
                    'id' => \Illuminate\Support\Str::uuid(),
                    'service_id' => $service->id,
                    'name' => $package['name'],
                    'price' => $package['price'],
                    'features' => $package['features'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('service_packages')->insert($packages);

        $this->command->info('Service packages seeded successfully!');
    }
}
