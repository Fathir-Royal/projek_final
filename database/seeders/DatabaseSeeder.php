<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// PENTING: Import ProductAndTransactionSeeder yang baru kita buat
use Database\Seeders\ProductAndTransactionSeeder; 

class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan proses seeding database.
     */
    public function run(): void
    {
        // --- 1. MEMBUAT AKUN UTAMA (USER SEEDING) ---
        User::create([
            'name' => 'Admin Gudang',
            'email' => 'admin@mail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'status' => 'approved',
        ]);

        User::create([
            'name' => 'Manager',
            'email' => 'manager@mail.com',
            'password' => Hash::make('123456'),
            'role' => 'manager',
            'status' => 'approved',
        ]);

        User::create([
            'name' => 'Staff',
            'email' => 'staff@mail.com',
            'password' => Hash::make('123456'),
            'role' => 'staff',
            'status' => 'approved',
        ]);

        // Akun SUPPLIER (Wajib ada untuk Restock/Transaksi)
        User::create([
            'name' => 'Bengkel Sahabat',
            'email' => 'sahabat@mail.com',
            'password' => Hash::make('123456'),
            'role' => 'supplier',
            'status' => 'approved', 
        ]);

        User::create([
            'name' => 'Bengkel Yanto',
            'email' => 'yanto@mail.com',
            'password' => Hash::make('123456'),
            'role' => 'supplier',
            'status' => 'approved',
        ]);


        // --- 2. MEMANGGIL SEEDER PRODUK & TRANSAKSI ---
        $this->call([
            ProductAndTransactionSeeder::class, 
        ]);
    }
}