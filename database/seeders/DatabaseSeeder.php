<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Level;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $level = Level::query()->firstOrCreate(
            ['level_kode' => 'ADM'],
            ['level_nama' => 'Administrator'],
        );

        User::query()->firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'level_id' => $level->level_id,
                'email_verified_at' => now(),
            ],
        );

        $kategori = Kategori::query()->firstOrCreate(
            ['kategori_kode' => 'UMUM'],
            ['kategori_nama' => 'Umum'],
        );

        Supplier::query()->firstOrCreate(
            ['supplier_kode' => 'SUP01'],
            [
                'supplier_nama' => 'Supplier Contoh',
                'supplier_alamat' => 'Jl. Contoh No. 1',
            ],
        );

        Barang::query()->firstOrCreate(
            ['barang_kode' => 'BRG001'],
            [
                'kategori_id' => $kategori->kategori_id,
                'barang_nama' => 'Barang Contoh',
                'harga_beli' => 10_000,
                'harga_jual' => 15_000,
            ],
        );
    }
}
