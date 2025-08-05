<?php

     namespace App\Models;

     use Illuminate\Database\Eloquent\Model;

     class DosenPengabdian extends Model {
         protected $fillable = ['dosen_id', 'pengabdian', 'pembicara', 'pengelola_jurnal', 'jabatan_struktural'];
     }