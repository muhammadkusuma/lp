<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'Administrator')->first();
        $managerRole = Role::where('name', 'Manajer')->first();
        $staffRole = Role::where('name', 'Staff')->first();
        
        $users = [
            [
                'id' => Str::uuid(),
                'name' => 'Budi Santoso',
                'email' => 'admin@company.com',
                'password' => Hash::make('password'),
                'role_id' => $adminRole?->id,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Siti Rahayu',
                'email' => 'manager@company.com',
                'password' => Hash::make('password'),
                'role_id' => $managerRole?->id,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Ahmad Wijaya',
                'email' => 'staff@company.com',
                'password' => Hash::make('password'),
                'role_id' => $staffRole?->id,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
