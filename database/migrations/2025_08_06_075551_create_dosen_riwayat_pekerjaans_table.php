<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenRiwayatPekerjaansTable extends Migration
{
    public function up()
    {
        Schema::create('dosen_riwayat_pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_profile_id');
            $table->string('nama_instansi');
            $table->string('jabatan');
            $table->string('jenis_instansi');
            $table->string('alamat_instansi');
            $table->string('periode_kerja');
            $table->string('surat_keterangan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('dosen_profile_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_riwayat_pekerjaans');
    }
}