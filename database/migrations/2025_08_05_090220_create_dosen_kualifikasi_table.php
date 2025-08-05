<?php

     use Illuminate\Database\Migrations\Migration;
     use Illuminate\Database\Schema\Blueprint;
     use Illuminate\Support\Facades\Schema;

     return new class extends Migration {
         public function up(): void {
             Schema::create('dosen_kualifikasi', function (Blueprint $table) {
                 $table->id();
                 $table->unsignedBigInteger('dosen_id');
                 $table->string('pendidikan_formal');
                 $table->string('diklat');
                 $table->text('riwayat_pekerjaan');
                 $table->timestamps();

                 $table->foreign('dosen_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
             });
         }

         public function down(): void {
             Schema::dropIfExists('dosen_kualifikasi');
         }
     };