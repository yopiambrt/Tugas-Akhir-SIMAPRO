<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMhsKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mhs_keluarga', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('nim');
            $table->string('ibu_nama');
            $table->text('ibu_alamat');
            $table->string('ibu_telepon');
            $table->string('ibu_pendidikan_terakhir');
            $table->string('ibu_pekerjaan');
            $table->string('ibu_gaji');
            $table->string('ayah_nama');
            $table->string('ayah_alamat');
            $table->string('ayah_telepon');
            $table->string('ayah_pendidikan_terakhir');
            $table->string('ayah_pekerjaan');
            $table->string('ayah_gaji');
            $table->string('kakak_jumlah')->default(0);
            $table->string('adik_jumlah')->default(0);
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
        Schema::dropIfExists('mhs_keluarga');
    }
}
