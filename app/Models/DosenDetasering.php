<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenDetasering extends Model
{
    protected $table = 'dosen_detasering';

    protected $fillable = [
        'dosen_profile_id', 'tahun_akademik', 'perguruan_tinggi_tujuan', 'bidang_penugasan',
        'periode_mulai', 'periode_selesai', 'surat_tugas_file', 'bukti_kegiatan_file',
        'keterangan_tambahan'
    ];

    public function dosenProfile()
    {
        return $this->belongsTo(DosenProfile::class);
    }
}