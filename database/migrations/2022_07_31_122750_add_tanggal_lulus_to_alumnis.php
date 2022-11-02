<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTanggalLulusToAlumnis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alumnis', function (Blueprint $table) {
            $table->dropColumn([
                'tahun_lulus'
            ]);
            $table->date("tanggal_lulus")->after("tanggal_terbit_ijasah")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alumnis', function (Blueprint $table) {
            $table->string("tahun_lulus");
            $table->dropColumn([
                'tanggal_lulus'
            ]);
        });
    }
}
