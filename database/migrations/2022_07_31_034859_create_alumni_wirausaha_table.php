<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniWirausahaTable extends Migration
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
            $table->unsignedBigInteger("user_id");
            $table->string("nama_pemilik");
            $table->string("nama_usaha");
            $table->date("tanggal_mulai");
            $table->unsignedBigInteger("city_id");
            $table->string("penghasilan");
            $table->string("umr");
            $table->unsignedBigInteger("jenis_usaha_id")->nullable();
            $table->unsignedBigInteger("level_usaha_id")->nullable();
            $table->unsignedBigInteger("kriteria_usaha_id")->nullable();
            $table->unsignedBigInteger("kriteria_pekerja_lepas_id")->nullable();
            $table->integer("tipe")->default(1)->comment("1.Membuka Usaha;2.Pekerja Lepas;");
            $table->integer("dijalankan_oleh")->default(1)->comment("1.Individu;2.Berpasangan;");
            $table->timestamps();

            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->foreign("jenis_usaha_id")
                ->references("id")
                ->on("master_jenis_usahas")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->foreign("level_usaha_id")
                ->references("id")
                ->on("master_level_usahas")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            
            $table->foreign("kriteria_usaha_id")
                ->references("id")
                ->on("master_kriteria_usahas")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            
            $table->foreign("kriteria_pekerja_lepas_id")
                ->references("id")
                ->on("master_kriteria_pekerja_lepas")
                ->onDelete("cascade")
                ->onUpdate("cascade");
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
