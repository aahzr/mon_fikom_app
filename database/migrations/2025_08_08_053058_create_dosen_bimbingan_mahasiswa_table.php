<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenBimbinganMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::create('dosen_bimbingan_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_profile_id');
            $table->string('tahun_akademik');
            $table->string('jenis_bimbingan');
            $table->string('nama_mahasiswa');
            $table->string('nim_mahasiswa');
            $table->string('judul_tema');
            $table->integer('jumlah_bimbingan');
            $table->string('bukti_bimbingan_file')->nullable();
            $table->string('status')->default('Berjalan');
            $table->timestamps();
            
            $table->foreign('dosen_profile_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_bimbingan_mahasiswa');
    }
}