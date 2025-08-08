<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenPengujianMahasiswa extends Model
{
    protected $table = 'dosen_pengujian_mahasiswa';

    protected $fillable = [
        'dosen_profile_id', 'tahun_akademik', 'jenis_ujian', 'nama_mahasiswa',
        'nim_mahasiswa', 'judul', 'tanggal_ujian', 'bukti_kehadiran_file'
    ];

    public function dosenProfile()
    {
        return $this->belongsTo(DosenProfile::class);
    }
}