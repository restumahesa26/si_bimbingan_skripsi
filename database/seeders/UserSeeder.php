<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'ADMIN',
            'password' => Hash::make('password')
        ]);

        $mahasiswa = User::create([
            'nama' => 'Diyah Ishita Azaharah',
            'username' => 'diyahishita',
            'email' => 'diyahishita@gmail.com',
            'role' => 'MAHASISWA',
            'password' => Hash::make('password')
        ]);

        Mahasiswa::create([
            'user_id' => $mahasiswa->id,
            'npm' => 'G1A019014'
        ]);

        $dosen = User::create([
            'nama' => 'Febrianto Ramandes',
            'username' => 'febrianto',
            'email' => 'febrianto@gmail.com',
            'role' => 'DOSEN',
            'password' => Hash::make('password')
        ]);

        Dosen::create([
            'user_id' => $dosen->id
        ]);
    }
}
