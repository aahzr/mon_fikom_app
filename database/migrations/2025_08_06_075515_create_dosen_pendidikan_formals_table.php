<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenPendidikanFormalsTable extends Migration
{
    public function up()
    {
        Schema::create('dosen_pendidikan_formals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_profile_id');
            $table->string('jenjang_pendidikan');
            $table->string('nama_institusi');
            $table->string('fakultas_jurusan');
            $table->string('gelar_akademik');
            $table->string('nomor_ijazah')->nullable();
            $table->date('tanggal_lulus');
            $table->string('negara_institusi');
            $table->string('file_scan_ijazah')->nullable();
            $table->string('status_verifikasi')->default('belum_verifikasi');
            $table->timestamps();

            $table->foreign('dosen_profile_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_pendidikan_formals');
    }
}