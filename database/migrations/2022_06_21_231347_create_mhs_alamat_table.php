<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMhsAlamatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mhs_alamat', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('nim')->nullable();
            $table->string('alamat_status')->nullable();
            $table->string('alamat_tinggal')->nullable();
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
        Schema::dropIfExists('mhs_alamat');
    }
}
