<?php

namespace Database\Seeders;

use App\Models\Bidang;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $sekretariat = Bidang::create([
            'nama_bidang' => 'Sekretariat',
            'keterangan' => 'Bidang sekretariat DPMPTSP',
        ]);

        $perizinan = Bidang::create([
            'nama_bidang' => 'Perizinan',
            'keterangan' => 'Bidang perizinan DPMPTSP',
        ]);

        User::create([
            'name' => 'Admin TU',
            'email' => 'admin@esurat.test',
            'password' => Hash::make('password'),
            'role' => 'admin_tu',
            'bidang_id' => null,
        ]);

        User::create([
            'name' => 'User Bidang Perizinan',
            'email' => 'bidang@esurat.test',
            'password' => Hash::make('password'),
            'role' => 'user_bidang',
            'bidang_id' => $perizinan->id,
        ]);
    }
}