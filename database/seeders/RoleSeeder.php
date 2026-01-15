<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Administrator'],
            ['name' => 'Manajer'],
            ['name' => 'Staff'],
            ['name' => 'Karyawan'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
