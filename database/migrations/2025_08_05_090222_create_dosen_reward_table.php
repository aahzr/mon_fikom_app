<?php

     use Illuminate\Database\Migrations\Migration;
     use Illuminate\Database\Schema\Blueprint;
     use Illuminate\Support\Facades\Schema;

     return new class extends Migration {
         public function up(): void {
             Schema::create('dosen_reward', function (Blueprint $table) {
                 $table->id();
                 $table->unsignedBigInteger('dosen_id');
                 $table->text('beasiswa');
                 $table->text('kesejahteraan');
                 $table->text('tunjangan');
                 $table->timestamps();

                 $table->foreign('dosen_id')->references('id')->on('dosen_profiles')->onDelete('cascade');
             });
         }

         public function down(): void {
             Schema::dropIfExists('dosen_reward');
         }
     };