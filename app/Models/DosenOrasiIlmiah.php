<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenOrasiIlmiah extends Model
{
    protected $table = 'dosen_orasi_ilmiah';

    protected $fillable = [
        'dosen_profile_id', 'tahun_akademik', 'judul_orasi', 'acara_kegiatan',
        'penyelenggara', 'tanggal_orasi', 'materi_file', 'bukti_dokumentasi_file'
    ];

    public function dosenProfile()
    {
        return $this->belongsTo(DosenProfile::class);
    }
}