<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniWirausahasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_wirausahas', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('jenis_wirausaha');
            $table->string('foto_usaha');
            $table->string('gaji');
            $table->string('bidang_wisausaha');
            $table->string('kategori_wisausaha');
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
        Schema::dropIfExists('alumni_wirausahas');
    }
}
