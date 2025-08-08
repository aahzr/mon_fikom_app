<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenOrasiIlmiahTable extends Migration
{
    public function up()
    {
        Schema::create('dosen_orasi_ilmiah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_profile_id');
            $table->string('tahun_akademik');
            $table->string('judul_orasi');
            $table->string('acara_kegiatan');
            $table->string('penyelenggara');
            $table->date('tanggal_orasi');
            $table->string('materi_file')->nullable();
            $table->string('bukti_dokumentasi_file')->nullable();
            $table->timestamps();
            
            $table->foreign('dosen_profile_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_orasi_ilmiah');
    }
}