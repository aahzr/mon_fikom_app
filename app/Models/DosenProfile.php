<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Model;

  class DosenProfile extends Model
  {
      protected $fillable = [
          'user_id', 'nama_lengkap', 'nidn_nip', 'tanggal_lahir', 'tempat_lahir',
          'jenis_kelamin', 'agama', 'nomor_telepon', 'alamat_domisili', 'email_pribadi',
          'foto_profil', 'status_inpassing', 'nomor_sk_inpassing', 'tanggal_sk_inpassing',
          'jenjang_pendidikan', 'jabatan_inpassing', 'instansi_sk_inpassing', 'jabatan_terakhir',
          'nomor_sk_jabfung', 'tanggal_sk_jabfung', 'masa_berlaku', 'file_sk_jabfung',
          'pangkat_terakhir', 'golongan_ruang', 'nomor_sk_pangkat', 'tanggal_sk_pangkat',
          'masa_kerja_golongan', 'instansi_sk_pangkat', 'fakultas', 'program_studi',
          'status_penempatan', 'tmt_penempatan', 'lokasi_kampus'
      ];

      public function user()
      {
          return $this->belongsTo(User::class);
      }
  }