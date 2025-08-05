<?php

  namespace Database\Seeders;

  use App\Models\DosenProfile;
  use App\Models\User;
  use Illuminate\Database\Seeder;

  class DosenProfileSeeder extends Seeder
  {
      public function run()
      {
          $user = User::where('email', 'dosen@example.com')->first();
          if ($user) {
              DosenProfile::create([
                  'user_id' => $user->id,
                  'nama_lengkap' => 'Dosen Contoh',
                  'nidn_nip' => '1234567890',
                  'tanggal_lahir' => '1980-01-01',
                  'tempat_lahir' => 'Jakarta',
                  'jenis_kelamin' => 'L',
                  'agama' => 'Islam',
                  'nomor_telepon' => '081234567890',
                  'alamat_domisili' => 'Jl. Contoh No. 1',
                  'email_pribadi' => 'dosen@example.com',
                  'fakultas' => 'Fakultas Ilmu Komputer',
                  'program_studi' => 'Informatika',
                  'status_penempatan' => 'Tetap',
                  'tmt_penempatan' => '2020-01-01',
                  'lokasi_kampus' => 'Kampus A',
              ]);
          }
      }
  }