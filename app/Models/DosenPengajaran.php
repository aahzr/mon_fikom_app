<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenPengajaran extends Model
{
    protected $table = 'dosen_pengajaran';

    protected $fillable = [
        'dosen_profile_id', 'tahun_akademik', 'semester', 'mata_kuliah', 'kode_mata_kuliah',
        'jumlah_sks', 'program_studi', 'kelas', 'jumlah_pertemuan', 'rps_file',
        'bukti_kehadiran_file', 'keterangan_tambahan'
    ];

    public function dosenProfile()
    {
        return $this->belongsTo(DosenProfile::class);
    }
}