<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKompetisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kompetisis', function (Blueprint $table) {
            $table->id();
            $table->string('id_kegiatan_skala');
            $table->string('id_kompetisi_label');
            $table->string('id_kompetisi_kategori');
            $table->string('kepanjangan');
            $table->text('deskripsi');
            $table->string('periode');
            $table->string('akun_update');
            $table->string('akun_create');
            $table->string('keterangan');
            $table->string('id_kompetisi_penyelenggara');
            $table->string('nama');
            $table->string('kota_kabupaten');
            $table->string('register_buka');
            $table->string('pelaksanaan_awal');
            $table->string('pelaksanaan_akhir');
            $table->string('register_tutup');
            $table->string('hadiah');
            $table->string('biaya');
            $table->string('tautan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kompetisis');
    }
}
