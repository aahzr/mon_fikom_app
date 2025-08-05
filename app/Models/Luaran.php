<?php

     namespace App\Models;

     use Illuminate\Database\Eloquent\Model;

     class Luaran extends Model {
         protected $fillable = ['dosen_id', 'judul', 'deskripsi', 'file_path', 'status'];
     }