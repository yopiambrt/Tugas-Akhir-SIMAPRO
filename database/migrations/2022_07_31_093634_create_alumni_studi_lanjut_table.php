<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniStudiLanjutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_studi_lanjuts', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->date("tanggal_mulai");
            $table->string("nama_universitas");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("univ_jenjang_id");
            $table->unsignedBigInteger("univ_kategori_id");
            $table->unsignedBigInteger("univ_level_id");
            $table->string("program_studi");
            $table->string("fakultas");
            $table->timestamps();

            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->foreign("univ_jenjang_id")
                ->references("id")
                ->on("master_universitas_jenjangs")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            
            $table->foreign("univ_kategori_id")
                ->references("id")
                ->on("master_universitas_kategoris")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->foreign("univ_level_id")
                ->references("id")
                ->on("master_universitas_levels")
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
        Schema::dropIfExists('alumni_studi_lanjuts');
    }
}
