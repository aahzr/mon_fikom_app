<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenDiklatsTable extends Migration
{
    public function up()
    {
        Schema::create('dosen_diklats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_profile_id');
            $table->string('nama_pelatihan');
            $table->string('penyelenggara');
            $table->string('jenis_pelatihan');
            $table->string('waktu_pelaksanaan');
            $table->integer('durasi_jam');
            $table->string('tempat');
            $table->string('sertifikat')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('status_verifikasi')->default('belum_verifikasi');
            $table->timestamps();

            $table->foreign('dosen_profile_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_diklats');
    }
}