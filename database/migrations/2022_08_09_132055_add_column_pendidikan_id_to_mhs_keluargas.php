<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPendidikanIdToMhsKeluargas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mhs_keluarga', function (Blueprint $table) {
            $table->dropColumn([
                'ibu_pendidikan_terakhir',
                'ayah_pendidikan_terakhir'
            ]);
            $table->unsignedBigInteger("ayah_pendidikan_id")->after("ayah_telepon")->nullable();
            $table->unsignedBigInteger("ibu_pendidikan_id")->after("ibu_telepon")->nullable();

            $table->foreign("ayah_pendidikan_id")
                ->references("id")
                ->on("master_pendidikans")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->foreign("ibu_pendidikan_id")
                ->references("id")
                ->on("master_pendidikans")
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
        Schema::table('mhs_keluarga', function (Blueprint $table) {
            $table->string("ayah_pendidikan_terakhir")->after("ayah_telepon")->nullable();
            $table->string("ibu_pendidikan_terakhir")->after("ibu_telepon")->nullable();

            $table->dropForeign(['ayah_pendidikan_id']);
            $table->dropForeign(['ibu_pendidikan_id']);

            $table->dropColumn(['ayah_pendidikan_id','ibu_pendidikan_id']);
        });
    }
}
