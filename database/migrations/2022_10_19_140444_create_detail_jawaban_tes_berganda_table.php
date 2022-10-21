<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailJawabanTesBergandaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_jawaban_tes_berganda', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jawaban');
            $table->unsignedBigInteger('id_soal');
            $table->unsignedBigInteger('id_pilihan_jawaban');
            $table->timestamps();

            $table->foreign('id_jawaban')->references('id')->on('jawaban');
            $table->foreign('id_soal')->references('id')->on('soal');
            $table->foreign('id_pilihan_jawaban')->references('id')->on('pilihan_jawaban_berganda');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_jawaban_tes_berganda');
    }
}
