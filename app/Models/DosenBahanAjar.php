<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenBahanAjar extends Model
{
    protected $table = 'dosen_bahan_ajar';

    protected $fillable = [
        'dosen_profile_id', 'tahun_akademik', 'mata_kuliah', 'judul_bahan_ajar',
        'jenis_bahan_ajar', 'file_bahan_ajar', 'tanggal_penyusunan', 'keterangan_tambahan'
    ];

    public function dosenProfile()
    {
        return $this->belongsTo(DosenProfile::class);
    }
}