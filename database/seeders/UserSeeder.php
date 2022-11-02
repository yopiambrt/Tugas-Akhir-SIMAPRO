<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('1'),
                'is_admin' => '1',
            ],
            [
                'name' => 'Mawa',
                'email' => 'mawa@mawa.com',
                'password' => bcrypt('1'),
                'is_admin' => '2',
            ],
            [
                'name' => 'Pegawai',
                'email' => 'Pegawai@pegawai.com',
                'password' => bcrypt('1'),
                'is_admin' => '3',
            ],
            [
                'name' => 'Mahasiswa',
                'email' => 'mhs@mhs.com',
                'password' => bcrypt('1'),
                'is_admin' => '4',
            ],
        ];

        foreach ($user as $key => $value) {
            \App\Models\User::firstOrCreate([
                'email' => $value["email"]
            ],$value);
        }
    }
}
