<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMhsSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mhs_sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('nim')->nullable();
            $table->string('jenis_sekolah_atas')->nullable();
            $table->string('nama_sekolah_atas')->nullable();
            $table->string('nama_smp')->nullable();
            $table->string('nama_sd')->nullable();
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
        Schema::dropIfExists('mhs_sekolah');
    }
}
