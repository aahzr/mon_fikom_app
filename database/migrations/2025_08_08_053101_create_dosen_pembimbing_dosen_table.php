<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenPembimbingDosenTable extends Migration
{
    public function up()
    {
        Schema::create('dosen_pembimbing_dosen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_profile_id');
            $table->string('tahun_akademik');
            $table->string('nama_dosen_dibimbing');
            $table->string('nidn_nip');
            $table->string('topik_pembimbingan');
            $table->string('periode_pembimbingan');
            $table->string('bukti_pembimbingan_file')->nullable();
            $table->text('keterangan_tambahan')->nullable();
            $table->timestamps();
            
            $table->foreign('dosen_profile_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_pembimbing_dosen');
    }
}