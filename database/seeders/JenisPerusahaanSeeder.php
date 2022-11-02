<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\JenisPerusahaan;

class JenisPerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisPerusahaan::updateOrCreate([
            'id' => 1,
            'nama' => 'Swasta'
        ],[
            'id' => 1,
            'nama' => 'Swasta'
        ]);

        JenisPerusahaan::updateOrCreate([
            'id' => 2,
            'nama' => 'Perusahaan Nirlaba'
        ],[
            'id' => 2,
            'nama' => 'Perusahaan Nirlaba'
        ]);

        JenisPerusahaan::updateOrCreate([
            'id' => 3,
            'nama' => 'Institusi / Organisasi Multilateral'
        ],[
            'id' => 3,
            'nama' => 'Institusi / Organisasi Multilateral'
        ]);

        JenisPerusahaan::updateOrCreate([
            'id' => 4,
            'nama' => 'Lembaga Pemerintahan'
        ],[
            'id' => 4,
            'nama' => 'Lembaga Pemerintahan'
        ]);

        JenisPerusahaan::updateOrCreate([
            'id' => 5,
            'nama' => 'BUMN'
        ],[
            'id' => 5,
            'nama' => 'BUMN'
        ]);

        JenisPerusahaan::updateOrCreate([
            'id' => 6,
            'nama' => 'BUMD'
        ],[
            'id' => 6,
            'nama' => 'BUMD'
        ]);
    }
}
