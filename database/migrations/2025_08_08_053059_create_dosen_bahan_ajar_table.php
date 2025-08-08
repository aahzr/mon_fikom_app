<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenBahanAjarTable extends Migration
{
    public function up()
    {
        Schema::create('dosen_bahan_ajar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_profile_id');
            $table->string('tahun_akademik');
            $table->string('mata_kuliah');
            $table->string('judul_bahan_ajar');
            $table->string('jenis_bahan_ajar');
            $table->string('file_bahan_ajar')->nullable();
            $table->date('tanggal_penyusunan');
            $table->text('keterangan_tambahan')->nullable();
            $table->timestamps();
            
            $table->foreign('dosen_profile_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_bahan_ajar');
    }
}