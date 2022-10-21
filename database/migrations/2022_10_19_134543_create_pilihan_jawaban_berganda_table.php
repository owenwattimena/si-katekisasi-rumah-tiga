<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePilihanJawabanBergandaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilihan_jawaban_berganda', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_soal');
            $table->text('nomor_pilihan');
            $table->mediumText('pilihan');
            $table->boolean('jawaban')->nullable();

            $table->foreign('id_soal')->references('id')->on('soal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pilihan_jawaban_berganda');
    }
}
