<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'username' => 'admin_perpus',
            'password' => Hash::make('password123'), // Ganti sesuai keinginan
            'email' => 'admin@gmail.com',
            'nama_lengkap' => 'Administrator Utama',
            'alamat' => 'Jl. Perpustakaan Pusat No. 1',
            'role' => 'admin',
        ]);

        // 2. Buat Akun Petugas
        User::create([
            'username' => 'petugas_rpl',
            'password' => Hash::make('password123'),
            'email' => 'petugas@gmail.com',
            'nama_lengkap' => 'Petugas Perpus',
            'alamat' => 'Gedung Perpustakaan Lantai 2',
            'role' => 'petugas',
        ]);

        // 3. Buat Akun Peminjam (User Biasa untuk tes)
        User::create([
            'username' => 'peminjam_aktif',
            'password' => Hash::make('password123'),
            'email' => 'peminjam@gmail.com',
            'nama_lengkap' => 'Andi Peminjam',
            'alamat' => 'Jl. Mawar Indah No. 10',
            'role' => 'pengunjung',
        ]);
    }
}
