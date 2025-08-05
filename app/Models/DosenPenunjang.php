<?php

     namespace App\Models;

     use Illuminate\Database\Eloquent\Model;

     class DosenPenunjang extends Model {
         protected $fillable = ['dosen_id', 'anggota_profesi', 'penghargaan', 'penunjang_lain'];
     }