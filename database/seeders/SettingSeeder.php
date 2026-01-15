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
                'value' => 'PT Perseorangan Digital Solutions',
                'type' => 'text',
            ],
            [
                'key' => 'site_description',
                'value' => 'Solusi Digital Terpercaya untuk Bisnis Anda',
                'type' => 'text',
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@ptperseorangan.com',
                'type' => 'email',
            ],
            [
                'key' => 'contact_phone',
                'value' => '021-12345678',
                'type' => 'text',
            ],
            [
                'key' => 'address',
                'value' => 'Jl. Sudirman No. 123, Jakarta Selatan 12190',
                'type' => 'textarea',
            ],
            [
                'key' => 'facebook_url',
                'value' => 'https://facebook.com/ptperseorangan',
                'type' => 'url',
            ],
            [
                'key' => 'instagram_url',
                'value' => 'https://instagram.com/ptperseorangan',
                'type' => 'url',
            ],
            [
                'key' => 'linkedin_url',
                'value' => 'https://linkedin.com/company/ptperseorangan',
                'type' => 'url',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
