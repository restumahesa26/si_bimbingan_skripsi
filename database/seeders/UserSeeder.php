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
            'nama' => 'Mufti Restu Mahesa',
            'username' => 'restumahesa',
            'email' => 'mufti.restumahesa@gmail.com',
            'role' => 'ADMIN',
            'password' => Hash::make('password')
        ]);

        $dosen = User::create([
            'nama' => 'Febrianto Ramandes',
            'username' => 'febri',
            'email' => 'febrianto@gmail.com',
            'role' => 'DOSEN',
            'password' => Hash::make('password')
        ]);


        $dosen2 = User::create([
            'nama' => 'Andrei Jonior Gustari',
            'username' => 'andreijonior',
            'email' => 'andrei@gmail.com',
            'role' => 'DOSEN',
            'password' => Hash::make('password')
        ]);

        $mahasiswa = User::create([
            'nama' => 'Diyah Ishita',
            'username' => 'diyahishita',
            'email' => 'diyahishita@gmail.com',
            'role' => 'MAHASISWA',
            'password' => Hash::make('password')
        ]);

        $mahasiswa2 = User::create([
            'nama' => 'Dewi Silvia',
            'username' => 'dewisilvia',
            'email' => 'dewisilvia@gmail.com',
            'role' => 'MAHASISWA',
            'password' => Hash::make('password')
        ]);

        Dosen::create([
            'user_id' => $dosen->id,
            'nip' => '123456789101112',
            'jabatan' => 'Ketua Prodi',
            'prodi' => 'Informatika',
            'fakultas' => 'Teknik',
            'status' => '1',
        ]);

        Dosen::create([
            'user_id' => $dosen2->id,
            'nip' => '12345678910111213',
            'jabatan' => 'Dosen',
            'prodi' => 'Informatika',
            'fakultas' => 'Teknik',
            'status' => '1',
        ]);

        Mahasiswa::create([
            'user_id' => $mahasiswa->id,
            'npm' => 'G1A019038'
        ]);

        Mahasiswa::create([
            'user_id' => $mahasiswa2->id,
            'npm' => 'G1A019022'
        ]);
    }
}
