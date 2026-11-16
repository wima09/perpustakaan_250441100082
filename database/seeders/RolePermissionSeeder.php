<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat role
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $petugas = Role::firstOrCreate(['name' => 'Petugas']);
        $siswa = Role::firstOrCreate(['name' => 'Siswa']);

        // Membuat permission
        $permissions = [
            'dashboard admin',
            'dashboard petugas',
            'lihat daftar buku',
            'kelola data buku',
            'kelola data pengguna',
            'kelola role pengguna',
            'kelola peminjaman',
            'kelola pengembalian',
            'mengajukan peminjaman',
            'lihat riwayat peminjaman sendiri',
            'lihat laporan perpustakaan',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Memberikan permission kepada Admin
        $admin->givePermissionTo($permissions);

        // Memberikan permission kepada Petugas
        $petugas->givePermissionTo([
            'dashboard petugas',
            'lihat daftar buku',
            'kelola data buku',
            'kelola peminjaman',
            'kelola pengembalian',
            'mengajukan peminjaman',
            'lihat laporan perpustakaan',
        ]);

        // Memberikan permission kepada Siswa
        $siswa->givePermissionTo([
            'lihat daftar buku',
            'mengajukan peminjaman',
            'lihat riwayat peminjaman sendiri',
        ]);
    }
}