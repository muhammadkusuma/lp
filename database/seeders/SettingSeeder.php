<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'PT Maju Bersama Teknologi',
            ],
            [
                'key' => 'site_description',
                'value' => 'Solusi Teknologi Informasi Terpercaya untuk Bisnis Indonesia',
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@majubersamatek.co.id',
            ],
            [
                'key' => 'contact_phone',
                'value' => '021-5551234',
            ],
            [
                'key' => 'address',
                'value' => 'Jl. Gatot Subroto No. 88, Kuningan, Jakarta Selatan 12710',
            ],
            [
                'key' => 'facebook_url',
                'value' => 'https://facebook.com/majubersamatek',
            ],
            [
                'key' => 'instagram_url',
                'value' => 'https://instagram.com/majubersamatek',
            ],
            [
                'key' => 'linkedin_url',
                'value' => 'https://linkedin.com/company/majubersamatek',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
