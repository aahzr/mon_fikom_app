<?php

     namespace App\Models;

     use Illuminate\Database\Eloquent\Model;

     class DosenPendidikan extends Model {
         protected $fillable = ['dosen_id', 'pengajaran_jam', 'bimbingan_mahasiswa', 'pengujian_mahasiswa', 'bahan_ajar', 'pembinaan_mahasiswa', 'visiting_scientist', 'detasering', 'orasi_ilmiah', 'pembimbingan_dosen', 'tugas_tambahan'];
     }