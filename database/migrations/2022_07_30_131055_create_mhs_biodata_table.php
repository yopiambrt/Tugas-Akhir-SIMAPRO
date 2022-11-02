<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMhsBiodataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mhs_biodatas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("nama");
            $table->string("email");
            $table->string("nim");
            $table->string("jk");
            $table->unsignedBigInteger("agama_id");
            $table->unsignedBigInteger("tempat_lahir");
            $table->date("tanggal_lahir");
            $table->unsignedBigInteger("city_id");
            $table->text("alamat");
            $table->string("pendidikan_terakhir");
            $table->string("kelas");
            $table->string("tahun_masuk");
            $table->timestamps();

            $table->foreign("user_id")
                  ->references("id")
                  ->on("users")
                  ->onDelete("cascade")
                  ->onUpdate("cascade");

            $table->foreign("agama_id")
                ->references("id")
                ->on("agamas")
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
        Schema::dropIfExists('mhs_biodatas');
    }
}
