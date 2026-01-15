<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Carbon\Carbon;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            [
                'company_name' => 'PT Mitra Sejahtera',
                'contact_name' => 'Bambang Suryanto',
                'email' => 'bambang@mitrasejahtera.com',
                'phone' => '021-98765432',
                'address' => 'Jl. Gatot Subroto No. 45, Setiabudi, Jakarta Selatan',
            ],
            [
                'company_name' => 'CV Teknologi Maju',
                'contact_name' => 'Dewi Lestari',
                'email' => 'dewi@tekmaju.com',
                'phone' => '021-87654321',
                'address' => 'Jl. Thamrin No. 78, Menteng, Jakarta Pusat',
            ],
            [
                'company_name' => 'Yayasan Pendidikan Maju Bersama',
                'contact_name' => 'Dr. Hendra Wijaya',
                'email' => 'hendra@yayasan.org',
                'phone' => '021-76543210',
                'address' => 'Jl. Kuningan Raya No. 90, Kuningan, Jakarta Selatan',
            ],
            [
                'company_name' => 'PT Berkah Sejahtera Indonesia',
                'contact_name' => 'Rina Kusumawati',
                'email' => 'rina@berkahsejahtera.co.id',
                'phone' => '021-55512345',
                'address' => 'Jl. Sudirman Kav. 52-53, Jakarta Selatan',
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
