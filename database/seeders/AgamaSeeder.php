<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agama;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agama::updateOrCreate([
            'agama' => 'Islam'
        ],[
            'agama' => 'Islam'
        ]);

        Agama::updateOrCreate([
            'agama' => 'Kristen Protestan'
        ],[
            'agama' => 'Kristen Protestan'
        ]);

        Agama::updateOrCreate([
            'agama' => 'Kristen Katholik'
        ],[
            'agama' => 'Kristen Katholik'
        ]);

        Agama::updateOrCreate([
            'agama' => 'Hindu'
        ],[
            'agama' => 'Hindu'
        ]);

        Agama::updateOrCreate([
            'agama' => 'Buddha'
        ],[
            'agama' => 'Buddha'
        ]);

        Agama::updateOrCreate([
            'agama' => 'Konghucu'
        ],[
            'agama' => 'Konghucu'
        ]);
    }
}
