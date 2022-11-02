<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniJabatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_jabatans', function (Blueprint $table) {
            $table->id();
            $table->string('id_level');
            $table->string('id_bidang_instansi');
            $table->string('nama_instansi');
            $table->string('email_instansi');
            $table->string('alamat_instansi');
            $table->string('lsm');
            $table->string('pbh');
            $table->string('yayasan');
            $table->string('siup');
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
        Schema::dropIfExists('alumni_jabatans');
    }
}
