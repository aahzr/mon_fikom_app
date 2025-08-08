<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenTugasTambahanTable extends Migration
{
    public function up()
    {
        Schema::create('dosen_tugas_tambahan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_profile_id');
            $table->string('tahun_akademik');
            $table->string('nama_jabatan');
            $table->string('periode_menjabat');
            $table->string('sk_file')->nullable();
            $table->text('keterangan_tambahan')->nullable();
            $table->timestamps();
            
            $table->foreign('dosen_profile_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_tugas_tambahan');
    }
}