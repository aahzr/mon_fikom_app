<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenPembinaanMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::create('dosen_pembinaan_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_profile_id');
            $table->string('tahun_akademik');
            $table->string('jenis_pembinaan');
            $table->string('nama_kegiatan');
            $table->string('periode_mulai');
            $table->string('periode_selesai');
            $table->string('lokasi');
            $table->string('bukti_dokumentasi_file')->nullable();
            $table->text('keterangan_tambahan')->nullable();
            $table->timestamps();
            
            $table->foreign('dosen_profile_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_pembinaan_mahasiswa');
    }
}