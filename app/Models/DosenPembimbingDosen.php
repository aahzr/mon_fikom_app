<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenPembimbingDosen extends Model
{
    protected $table = 'dosen_pembimbing_dosen';

    protected $fillable = [
        'dosen_profile_id', 'tahun_akademik', 'nama_dosen_dibimbing', 'nidn_nip',
        'topik_pembimbingan', 'periode_pembimbingan', 'bukti_pembimbingan_file',
        'keterangan_tambahan'
    ];

    public function dosenProfile()
    {
        return $this->belongsTo(DosenProfile::class);
    }
}