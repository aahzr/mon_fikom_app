<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenBimbinganMahasiswa extends Model
{
    protected $table = 'dosen_bimbingan_mahasiswa';

    protected $fillable = [
        'dosen_profile_id', 'tahun_akademik', 'jenis_bimbingan', 'nama_mahasiswa',
        'nim_mahasiswa', 'judul_tema', 'jumlah_bimbingan', 'bukti_bimbingan_file',
        'status'
    ];

    public function dosenProfile()
    {
        return $this->belongsTo(DosenProfile::class);
    }
}