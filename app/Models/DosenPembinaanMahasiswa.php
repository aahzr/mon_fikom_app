<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenPembinaanMahasiswa extends Model
{
    protected $table = 'dosen_pembinaan_mahasiswa';

    protected $fillable = [
        'dosen_profile_id', 'tahun_akademik', 'jenis_pembinaan', 'nama_kegiatan',
        'periode_mulai', 'periode_selesai', 'lokasi', 'bukti_dokumentasi_file',
        'keterangan_tambahan'
    ];

    public function dosenProfile()
    {
        return $this->belongsTo(DosenProfile::class);
    }
}