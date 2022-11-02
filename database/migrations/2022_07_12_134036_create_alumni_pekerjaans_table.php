<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniPekerjaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->string('id_instansi');
            $table->string('tgl_masuk');
            $table->string('id_kategori');
            $table->string('id_jenis_pekerjaan');
            $table->string('id_jabatan');
            $table->string('gaji');
            $table->string('umr');
            $table->string('foto');
            $table->string('pppk');
            $table->string('pns');
            $table->string('pkbkkpw');
            $table->string('pkkkpw');
            $table->string('pkwwt');
            $table->string('kontak');
            $table->string('user_id');
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
        Schema::dropIfExists('alumni_pekerjaans');
    }
}
