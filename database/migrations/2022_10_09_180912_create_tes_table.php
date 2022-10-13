<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_periode');
            $table->string('judul');
            $table->string('soal');
            $table->mediumText('keterangan');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->timestamp('dibuat_pada')->useCurrent();

            $table->foreign('id_periode')->references('id')->on('periode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tes');
    }
}
