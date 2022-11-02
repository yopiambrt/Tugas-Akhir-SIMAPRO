<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkunPeranStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akun_peran_status', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('id_akun_status')->nullable();
            $table->string('id_peran')->nullable();
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
        Schema::dropIfExists('akun_peran_status');
    }
}
