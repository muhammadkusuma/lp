<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lead;
use Carbon\Carbon;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        $leads = [
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@email.com',
                'status' => 'New',
                'source' => 'Website',
            ],
            [
                'name' => 'Siti Rahma Wati',
                'email' => 'siti.rahma@email.com',
                'status' => 'New',
                'source' => 'Referral',
            ],
            [
                'name' => 'Budi Hartono',
                'email' => 'budi.h@email.com',
                'status' => 'Qualified',
                'source' => 'Social Media',
            ],
            [
                'name' => 'Dewi Kusuma',
                'email' => 'dewi.kusuma@email.com',
                'status' => 'New',
                'source' => 'Google Ads',
            ],
            [
                'name' => 'Rudi Setiawan',
                'email' => 'rudi.setiawan@email.com',
                'status' => 'Contacted',
                'source' => 'Website',
            ],
        ];

        foreach ($leads as $lead) {
            Lead::create($lead);
        }
    }
}
