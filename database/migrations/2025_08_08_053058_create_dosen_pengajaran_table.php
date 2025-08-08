<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenPengajaranTable extends Migration
{
    public function up()
    {
        Schema::create('dosen_pengajaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_profile_id');
            $table->string('tahun_akademik');
            $table->string('semester');
            $table->string('mata_kuliah');
            $table->string('kode_mata_kuliah');
            $table->integer('jumlah_sks');
            $table->string('program_studi');
            $table->string('kelas');
            $table->integer('jumlah_pertemuan');
            $table->string('rps_file')->nullable();
            $table->string('bukti_kehadiran_file')->nullable();
            $table->text('keterangan_tambahan')->nullable();
            $table->timestamps();
            
            $table->foreign('dosen_profile_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_pengajaran');
    }
}