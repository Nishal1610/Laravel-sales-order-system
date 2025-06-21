<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create roles if not exists
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $salesRole = Role::firstOrCreate(['name' => 'sales']);

        // Create users
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => Hash::make('password')]
        );

        $sales = User::firstOrCreate(
            ['email' => 'sales@example.com'],
            ['name' => 'Salesperson', 'password' => Hash::make('password')]
        );

        // Assign roles using Spatie
        $admin->assignRole($adminRole);
        $sales->assignRole($salesRole);
    }
}
