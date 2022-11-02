<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSetelahLulusIdToAlumni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alumnis', function (Blueprint $table) {
            $table->dropForeign(["setelah_lulus_id"]);
            $table->dropColumn([
                'setelah_lulus_id'
            ]);

            $table->unsignedBigInteger("status_pekerjaan_id")->after("upload_foto_ijasah")->nullable();

            $table->foreign("status_pekerjaan_id")
                ->references("id")
                ->on("master_status_pekerjaans")
                ->onDelete("cascade")
                ->onUpdate("cascade");
        });

        Schema::dropIfExists('alumni_statuses');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alumnis', function (Blueprint $table) {
            $table->unsignedBigInteger("setelah_lulus_id")->nullable();
            $table->foreign("setelah_lulus_id")
                ->references("id")
                ->on("alumni_statuses")
                ->onDelete("cascade")
                ->onUpdate("cascade");
        });
    }
}
