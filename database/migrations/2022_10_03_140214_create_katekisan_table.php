<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKatekisanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('katekisan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nama_panggilan');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->tinyInteger('anak_ke');
            $table->string('unit');
            $table->string('sektor');
            $table->integer('tahun_baptis');
            $table->string('pendidikan');
            $table->string('status');
            $table->string('telp_hp');
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('unit_ayah')->nullable();
            $table->string('sektor_ayah')->nullable();
            $table->string('telp_hp_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('unit_ibu')->nullable();
            $table->string('sektor_ibu')->nullable();
            $table->string('telp_hp_ibu')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('unit_wali')->nullable();
            $table->string('sektor_wali')->nullable();
            $table->string('telp_hp_wali')->nullable();
            $table->string('ijazah_terakhir');
            $table->string('pas_foto');
            $table->string('sertifikat_wasmi');
            $table->string('akte_kelahiran');
            $table->tinyInteger('status_katekumen')->default(0);
            // [0 'Menunggu Diterima', 1 'Diterima', 2 'Ditolak', 3 'Lulus', 4 'Tidak Lulus', 5 'Tidak Aktif']
            $table->unsignedBigInteger('id_periode');

            $table->foreign('id_periode')->references('id')->on('periode')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('katekisan');
    }
}
