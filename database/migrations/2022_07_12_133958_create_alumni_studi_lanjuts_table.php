<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniStudiLanjutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_studi_lanjuts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('tahun_masuk');
            $table->string('fakultas');
            $table->string('prodi');
            $table->string('id_jenjang');
            $table->string('nama_universitas');
            $table->string('kategori_universitas');
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
        Schema::dropIfExists('alumni_studi_lanjuts');
    }
}
