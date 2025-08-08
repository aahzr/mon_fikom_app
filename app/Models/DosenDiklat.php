<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenDiklat extends Model
{
    protected $fillable = [
        'dosen_profile_id', 'nama_pelatihan', 'penyelenggara', 'jenis_pelatihan',
        'waktu_pelaksanaan', 'durasi_jam', 'tempat', 'sertifikat',
        'keterangan', 'status_verifikasi'
    ];

    public function dosenProfile()
    {
        return $this->belongsTo(DosenProfile::class);
    }
}