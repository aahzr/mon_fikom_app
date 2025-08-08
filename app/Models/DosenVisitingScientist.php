<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenVisitingScientist extends Model
{
    protected $table = 'dosen_visiting_scientist';

    protected $fillable = [
        'dosen_profile_id', 'tahun_akademik', 'nama_institusi_tujuan', 'negara_daerah',
        'tanggal_mulai', 'tanggal_selesai', 'topik_kegiatan', 'surat_tugas_file',
        'bukti_dokumentasi_file', 'keterangan_tambahan'
    ];

    public function dosenProfile()
    {
        return $this->belongsTo(DosenProfile::class);
    }
}