<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenPengujianMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::create('dosen_pengujian_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_profile_id');
            $table->string('tahun_akademik');
            $table->string('jenis_ujian');
            $table->string('nama_mahasiswa');
            $table->string('nim_mahasiswa');
            $table->string('judul');
            $table->date('tanggal_ujian');
            $table->string('bukti_kehadiran_file')->nullable();
            $table->timestamps();
            
            $table->foreign('dosen_profile_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_pengujian_mahasiswa');
    }
}