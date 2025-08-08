<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenPendidikanFormal extends Model
{
    protected $fillable = [
        'dosen_profile_id', 'jenjang_pendidikan', 'nama_institusi', 'fakultas_jurusan',
        'gelar_akademik', 'nomor_ijazah', 'tanggal_lulus', 'negara_institusi',
        'file_scan_ijazah', 'status_verifikasi'
    ];

    public function dosenProfile()
    {
        return $this->belongsTo(DosenProfile::class);
    }
}