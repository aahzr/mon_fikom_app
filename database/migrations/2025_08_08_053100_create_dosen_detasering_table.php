<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenDetaseringTable extends Migration
{
    public function up()
    {
        Schema::create('dosen_detasering', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_profile_id');
            $table->string('tahun_akademik');
            $table->string('perguruan_tinggi_tujuan');
            $table->string('bidang_penugasan');
            $table->date('periode_mulai');
            $table->date('periode_selesai');
            $table->string('surat_tugas_file')->nullable();
            $table->string('bukti_kegiatan_file')->nullable();
            $table->text('keterangan_tambahan')->nullable();
            $table->timestamps();
            
            $table->foreign('dosen_profile_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_detasering');
    }
}