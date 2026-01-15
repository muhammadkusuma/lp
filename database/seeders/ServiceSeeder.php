<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Web Development',
                'title' => 'Jasa Pembuatan Website',
                'description' => 'Layanan pembuatan website profesional dengan teknologi terkini',
                'price_start' => 5000000,
                'status' => 'active',
            ],
            [
                'name' => 'Mobile App Development',
                'title' => 'Jasa Pembuatan Aplikasi Mobile',
                'description' => 'Pengembangan aplikasi mobile untuk Android dan iOS',
                'price_start' => 15000000,
                'status' => 'active',
            ],
            [
                'name' => 'UI/UX Design',
                'title' => 'Jasa Desain UI/UX',
                'description' => 'Desain antarmuka dan pengalaman pengguna yang menarik',
                'price_start' => 3000000,
                'status' => 'active',
            ],
            [
                'name' => 'Digital Marketing',
                'title' => 'Jasa Digital Marketing',
                'description' => 'Strategi pemasaran digital untuk meningkatkan bisnis Anda',
                'price_start' => 2000000,
                'status' => 'active',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
