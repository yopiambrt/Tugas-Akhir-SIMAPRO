<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                'name' => 'Admin Sekre',
                'is_admin' => '1',
            ],
            [
                'name' => 'Mawa',
                'is_admin' => '2',
            ],
            [
                'name' => 'Pegawai',
                'is_admin' => '3',
            ],
            [
                'name' => 'Mahasiswa',
                'is_admin' => '4',
            ],
        ];

        foreach ($role as $key => $value) {
            \App\Models\Role::firstOrCreate([
                'is_admin' => $value["is_admin"]
            ],$value);
        }
    }
}
