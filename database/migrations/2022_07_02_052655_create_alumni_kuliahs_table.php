<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniKuliahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('nama_univ')->nullable();
            $table->string('alamat_instansi')->nullable();
            $table->string('jurusan')->nullable();
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
        Schema::dropIfExists('alumni_kuliahs');
    }
}
