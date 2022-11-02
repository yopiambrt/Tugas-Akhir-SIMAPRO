<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniAkunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_akuns', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('tahun_lulus');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('tanggal_wisuda');
            $table->string('tahun_masuk');
            $table->string('nik');
            $table->string('foto');
            $table->string('nim');
            $table->string('status');
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
        Schema::dropIfExists('alumni_akuns');
    }
}
