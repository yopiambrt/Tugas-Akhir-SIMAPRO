<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\StatusPekerjaan;

class StatusPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusPekerjaan::updateOrCreate([
            'id' => 1,
            'nama' => 'Belum Bekerja'
        ],[
            'id' => 1,
            'nama' => 'Belum Bekerja'
        ]);

        StatusPekerjaan::updateOrCreate([
            'id' => 2,
            'nama' => 'Bekerja'
        ],[
            'id' => 2,
            'nama' => 'Bekerja'
        ]);

        StatusPekerjaan::updateOrCreate([
            'id' => 3,
            'nama' => 'Membuka Usaha'
        ],[
            'id' => 3,
            'nama' => 'Membuka Usaha'
        ]);

        StatusPekerjaan::updateOrCreate([
            'id' => 4,
            'nama' => 'Studi Lanjut'
        ],[
            'id' => 4,
            'nama' => 'Studi Lanjut'
        ]);
    }
}
