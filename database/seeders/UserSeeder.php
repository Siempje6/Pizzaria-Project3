<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
    ]);

    $superadmin = User::create([
        'name' => 'Superadmin User',
        'email' => 'superadmin@example.com',
        'password' => bcrypt('password'),
    ]);

    $admin->assignRole('admin');
    $superadmin->assignRole('superadmin');
}
}
