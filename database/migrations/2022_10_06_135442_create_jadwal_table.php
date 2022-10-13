<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('uniq_id')->unique();
            $table->date('tanggal');
            $table->time('jam');
            $table->string('tempat');
            $table->unsignedBigInteger('id_pengajar');
            $table->unsignedBigInteger('id_periode');

            $table->foreign('id_pengajar')->references('id')->on('users');
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
        Schema::dropIfExists('jadwal');
    }
}
