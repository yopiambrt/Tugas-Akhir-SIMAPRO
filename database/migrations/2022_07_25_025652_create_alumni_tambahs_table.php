<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniTambahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_tambahs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->char('nama');
            $table->char('nim');
            $table->char('angkatan');
            $table->char('pekerjaan');
            $table->char('instansi');
            $table->char('tglmasuk');
            $table->char('jabatan');
            $table->char('gaji');
            $table->char('umr');
            $table->char('kategori');
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
        Schema::dropIfExists('alumni_tambahs');
    }
}
