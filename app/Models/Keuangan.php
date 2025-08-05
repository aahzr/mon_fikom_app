<?php

     namespace App\Models;

     use Illuminate\Database\Eloquent\Model;

     class Keuangan extends Model {
         protected $fillable = ['dosen_id', 'judul', 'jumlah', 'deskripsi', 'file_path', 'status'];
     }