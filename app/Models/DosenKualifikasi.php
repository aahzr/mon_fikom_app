<?php

     namespace App\Models;

     use Illuminate\Database\Eloquent\Model;

     class DosenKualifikasi extends Model {
         protected $fillable = ['dosen_id', 'pendidikan_formal', 'diklat', 'riwayat_pekerjaan'];
     }