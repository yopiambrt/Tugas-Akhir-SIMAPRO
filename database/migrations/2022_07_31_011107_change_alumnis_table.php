<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAlumnisTable extends Migration
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
                'status'
            ]);

            $table->integer("status_kelulusan")->default(0)->commet("1.Lulus;0.Belum Lulus")->after("id");
            $table->string("tahun_lulus")->aftert("status_kelulusan")->nullable();
            $table->string("tanggal_terbit_ijasah")->after("tahun_lulus")->nullable();
            $table->string("upload_foto_ijasah")->after("tanggal_terbit_ijasah")->nullable();
            $table->unsignedBigInteger("setelah_lulus_id")->after("upload_foto_ijasah")->nullable();
            $table->integer("status_verifikasi")->after("setelah_lulus_id")->default(0)->comment("1.Diverifikasi;0.Belum Diverfikasi");

            $table->foreign("setelah_lulus_id")
                  ->references("id")
                  ->on("alumni_statuses")
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
        Schema::table('alumnis', function (Blueprint $table) {
            $table->string("status")->nullable();
            $table->dropForeign(['setelah_lulus_id']);
            $table->dropColumn([
                'status_kelulusan',
                'tahun_lulus',
                'tanggal_terbit_ijasah',
                'upload_foto_ijasah',
                'setelah_lulus_id',
                'status_verifikasi'
            ]);
        });
    }
}
