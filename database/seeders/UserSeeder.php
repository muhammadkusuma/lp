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
        $adminRole = Role::where('name', 'Admin')->first();
        $managerRole = Role::where('name', 'Manager')->first();
        
        $users = [
            [
                'id' => Str::uuid(),
                'name' => 'Admin User',
                'email' => 'admin@company.com',
                'password' => Hash::make('password'),
                'role_id' => $adminRole?->id,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Manager User',
                'email' => 'manager@company.com',
                'password' => Hash::make('password'),
                'role_id' => $managerRole?->id,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
