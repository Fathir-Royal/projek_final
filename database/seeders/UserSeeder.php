<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123456'),
            'role' => 'admin',
            'is_approved' => true,
        ]);

        User::create([
            'name' => 'Manager',
            'email' => 'manager@mail.com',
            'password' => bcrypt('123456'),
            'role' => 'manager',
            'is_approved' => true,
        ]);

        User::create([
            'name' => 'Staff',
            'email' => 'staff@mail.com',
            'password' => bcrypt('123456'),
            'role' => 'staff',
            'is_approved' => true,
        ]);

        User::create([
            'name' => 'Supplier ABC',
            'email' => 'supplier@mail.com',
            'password' => bcrypt('123456'),
            'role' => 'supplier',
            'is_approved' => true,
        ]);
    }
}
