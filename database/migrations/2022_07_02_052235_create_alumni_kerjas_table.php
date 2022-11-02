<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('nama_instansi')->nullable();
            $table->string('alamat_kerja')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('tahun_masuk')->nullable();
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
        Schema::dropIfExists('alumni_kerjas');
    }
}
