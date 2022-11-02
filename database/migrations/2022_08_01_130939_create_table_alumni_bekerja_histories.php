<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAlumniBekerjaHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_bekerja_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("jenis_perusahaan_id");
            $table->string("nama")->nullable();
            $table->date("tanggal_mulai")->nullable();
            $table->string("nama_instansi")->nullable();
            $table->unsignedBigInteger("city_id")->nullable();
            $table->string("gaji_pertama")->nullable();
            $table->string("umr")->nullable();
            $table->string("contact")->nullable();
            $table->string("jenis_pekerjaan")->nullable();
            $table->string("jabatan")->nullable();
            $table->unsignedBigInteger("kategori_pekerjaan_id")->nullable();
            $table->unsignedBigInteger("level_instansi_id")->nullable();
            $table->integer("pkwt")->default(0)->comment("1.Yes;0.Tidak");
            $table->integer("pkwtt")->default(0)->comment("1.Yes;0.Tidak");
            $table->integer("yayasan")->default(0)->comment("1.Yes;0.Tidak");
            $table->integer("pbh")->default(0)->comment("1.Yes;0.Tidak");
            $table->integer("lsm")->default(0)->comment("1.Yes;0.Tidak");
            $table->integer("siup")->default(0)->comment("1.Yes;0.Tidak");
            $table->integer("pns")->default(0)->comment("1.Yes;0.Tidak");
            $table->integer("pppk")->default(0)->comment("1.Yes;0.Tidak");
            $table->timestamps();

            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->foreign("jenis_perusahaan_id")
                ->references("id")
                ->on("master_jenis_perusahaans")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->foreign("kategori_pekerjaan_id")
                ->references("id")
                ->on("master_kategori_pekerjaans")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->foreign("level_instansi_id")
                ->references("id")
                ->on("master_level_instansis")
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
        Schema::dropIfExists('alumni_bekerja_histories');
    }
}
