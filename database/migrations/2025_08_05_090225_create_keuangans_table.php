<?php

     use Illuminate\Database\Migrations\Migration;
     use Illuminate\Database\Schema\Blueprint;
     use Illuminate\Support\Facades\Schema;

     return new class extends Migration {
         public function up(): void {
             Schema::create('keuangans', function (Blueprint $table) {
                 $table->id();
                 $table->unsignedBigInteger('dosen_id');
                 $table->string('judul');
                 $table->decimal('jumlah', 15, 2);
                 $table->text('deskripsi');
                 $table->string('file_path')->nullable();
                 $table->enum('status', ['draft', 'submitted', 'approved', 'rejected'])->default('draft');
                 $table->timestamps();

                 $table->foreign('dosen_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
             });
         }

         public function down(): void {
             Schema::dropIfExists('keuangans');
         }
     };