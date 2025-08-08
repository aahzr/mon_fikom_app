<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenTugasTambahan extends Model
{
    protected $table = 'dosen_tugas_tambahan';

    protected $fillable = [
        'dosen_profile_id', 'tahun_akademik', 'nama_jabatan', 'periode_menjabat',
        'sk_file', 'keterangan_tambahan'
    ];

    public function dosenProfile()
    {
        return $this->belongsTo(DosenProfile::class);
    }
}