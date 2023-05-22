<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Eulis Jubaedah',
            'username' => 'eulis',
            'nomor_induk' => '10107025',
            'jabatan' => 'Sekretaris',
            'status' => 'Aktif',
            'angkatan' => '2022',
            'email' => 'eulis@gmail.com',
            'password' => bcrypt('eulis')
        ]);
        User::create([
            'name' => 'Tia Rostiawati',
            'username' => 'tia',
            'nomor_induk' => '10107061',
            'jabatan' => 'Pengurus',
            'status' => 'Aktif',
            'angkatan' => '2022',
            'email' => 'tia@gmail.com',
            'password' => bcrypt('tia')
        ]);
        User::create([
            'name' => 'Bagus Semesta',
            'username' => 'bagus',
            'nomor_induk' => '10107011',
            'jabatan' => 'Pengurus',
            'status' => 'Aktif',
            'angkatan' => '2022',
            'email' => 'bagus@gmail.com',
            'password' => bcrypt('bagus')
        ]);
        User::create([
            'name' => 'Haryati',
            'username' => 'haryati',
            'nomor_induk' => '1031892342343',
            'jabatan' => 'Pembina',
            'status' => 'Aktif',
            'angkatan' => '2022',
            'email' => 'haryati@gmail.com',
            'password' => bcrypt('haryati')
        ]);
        User::create([
            'name' => 'Singgih Sutan S',
            'username' => 'singgih',
            'nomor_induk' => '10107059',
            'jabatan' => 'Ketua',
            'status' => 'Aktif',
            'angkatan' => '2022',
            'email' => 'singgih@gmail.com',
            'password' => bcrypt('singgih')
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
