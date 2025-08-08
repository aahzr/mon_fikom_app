<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenVisitingScientistTable extends Migration
{
    public function up()
    {
        Schema::create('dosen_visiting_scientist', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_profile_id');
            $table->string('tahun_akademik');
            $table->string('nama_institusi_tujuan');
            $table->string('negara_daerah');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('topik_kegiatan');
            $table->string('surat_tugas_file')->nullable();
            $table->string('bukti_dokumentasi_file')->nullable();
            $table->text('keterangan_tambahan')->nullable();
            $table->timestamps();
            
            $table->foreign('dosen_profile_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_visiting_scientist');
    }
}