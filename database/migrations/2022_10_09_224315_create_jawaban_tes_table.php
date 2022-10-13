<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanTesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_tes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tes');
            $table->unsignedBigInteger('id_katekisan');
            $table->string('jawaban');
            $table->timestamp('tanggal_unggah')->useCurrent();

            $table->foreign('id_tes')->references('id')->on('tes');
            $table->foreign('id_katekisan')->references('id')->on('katekisan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban_tes');
    }
}
