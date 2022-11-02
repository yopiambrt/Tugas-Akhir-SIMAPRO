<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKompetisiMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kompetisi_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('nama_kompetisi');
            $table->string('team');
            $table->string('hasil_kompetisi');
            $table->string('status');
            $table->string('tanggal_upload');
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
        Schema::dropIfExists('kompetisi_mahasiswas');
    }
}
