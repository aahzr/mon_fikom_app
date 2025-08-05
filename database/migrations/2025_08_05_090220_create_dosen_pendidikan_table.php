<?php

     use Illuminate\Database\Migrations\Migration;
     use Illuminate\Database\Schema\Blueprint;
     use Illuminate\Support\Facades\Schema;

     return new class extends Migration {
         public function up(): void {
             Schema::create('dosen_pendidikan', function (Blueprint $table) {
                 $table->id();
                 $table->unsignedBigInteger('dosen_id');
                 $table->integer('pengajaran_jam');
                 $table->integer('bimbingan_mahasiswa');
                 $table->integer('pengujian_mahasiswa');
                 $table->text('bahan_ajar');
                 $table->text('pembinaan_mahasiswa');
                 $table->string('visiting_scientist')->nullable();
                 $table->string('detasering')->nullable();
                 $table->string('orasi_ilmiah')->nullable();
                 $table->integer('pembimbingan_dosen')->nullable();
                 $table->text('tugas_tambahan')->nullable();
                 $table->timestamps();

                 $table->foreign('dosen_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
             });
         }

         public function down(): void {
             Schema::dropIfExists('dosen_pendidikan');
         }
     };