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
                'name' => 'PT Mitra Sejahtera',
                'email' => 'contact@mitrasejahtera.com',
                'phone' => '021-98765432',
                'address' => 'Jl. Gatot Subroto No. 45, Jakarta',
                'company' => 'PT Mitra Sejahtera',
                'status' => 'active',
            ],
            [
                'name' => 'CV Teknologi Maju',
                'email' => 'info@tekmaju.com',
                'phone' => '021-87654321',
                'address' => 'Jl. Thamrin No. 78, Jakarta',
                'company' => 'CV Teknologi Maju',
                'status' => 'active',
            ],
            [
                'name' => 'Yayasan Pendidikan Maju Bersama',
                'email' => 'contact@yayasan.org',
                'phone' => '021-76543210',
                'address' => 'Jl. Kuningan No. 90, Jakarta',
                'company' => 'Yayasan Pendidikan Maju Bersama',
                'status' => 'active',
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
