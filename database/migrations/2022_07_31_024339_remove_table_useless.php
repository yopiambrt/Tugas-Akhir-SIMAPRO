<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTableUseless extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('alumni_akuns');
        Schema::dropIfExists('alumni_bidang_instansis');
        Schema::dropIfExists('alumni_jabatans');
        Schema::dropIfExists('alumni_jenis_instansis');
        Schema::dropIfExists('alumni_ketegoris');
        Schema::dropIfExists('alumni_kerjas');
        Schema::dropIfExists('alumni_kuliahs');
        Schema::dropIfExists('alumni_levels');
        Schema::dropIfExists('alumni_pekerjaans');
        Schema::dropIfExists('alumni_studi_lanjut_jenjangs');
        Schema::dropIfExists('alumni_studi_lanjuts');
        Schema::dropIfExists('alumni_wirausahas');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
