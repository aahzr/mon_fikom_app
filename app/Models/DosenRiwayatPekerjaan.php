<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenRiwayatPekerjaan extends Model
{
    protected $fillable = [
        'dosen_profile_id', 'nama_instansi', 'jabatan', 'jenis_instansi',
        'alamat_instansi', 'periode_kerja', 'surat_keterangan', 'keterangan'
    ];

    public function dosenProfile()
    {
        return $this->belongsTo(DosenProfile::class);
    }
}