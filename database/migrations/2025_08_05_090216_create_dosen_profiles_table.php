<?php

  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\Schema;

  class CreateDosenProfilesTable extends Migration
  {
      public function up()
      {
          Schema::create('dosen_profiles', function (Blueprint $table) {
              $table->id();
              $table->unsignedBigInteger('user_id');
              $table->string('nama_lengkap');
              $table->string('nidn_nip')->nullable();
              $table->date('tanggal_lahir');
              $table->string('tempat_lahir');
              $table->enum('jenis_kelamin', ['L', 'P']);
              $table->string('agama');
              $table->string('nomor_telepon');
              $table->string('alamat_domisili');
              $table->string('email_pribadi')->unique();
              $table->string('foto_profil')->nullable();
              $table->boolean('status_inpassing')->default(false);
              $table->string('nomor_sk_inpassing')->nullable();
              $table->date('tanggal_sk_inpassing')->nullable();
              $table->string('jenjang_pendidikan')->nullable();
              $table->string('jabatan_inpassing')->nullable();
              $table->string('instansi_sk_inpassing')->nullable();
              $table->string('jabatan_terakhir')->nullable();
              $table->string('nomor_sk_jabfung')->nullable();
              $table->date('tanggal_sk_jabfung')->nullable();
              $table->date('masa_berlaku')->nullable();
              $table->string('file_sk_jabfung')->nullable();
              $table->string('pangkat_terakhir')->nullable();
              $table->string('golongan_ruang')->nullable();
              $table->string('nomor_sk_pangkat')->nullable();
              $table->date('tanggal_sk_pangkat')->nullable();
              $table->integer('masa_kerja_golongan')->nullable();
              $table->string('instansi_sk_pangkat')->nullable();
              $table->string('fakultas');
              $table->string('program_studi');
              $table->enum('status_penempatan', ['Tetap', 'Tidak Tetap', 'Kontrak']);
              $table->date('tmt_penempatan');
              $table->string('lokasi_kampus');
              $table->timestamps();

              $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          });
      }

      public function down()
      {
          Schema::dropIfExists('dosen_profiles');
      }
  }