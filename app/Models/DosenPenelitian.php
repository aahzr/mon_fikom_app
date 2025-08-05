<?php

     namespace App\Models;

     use Illuminate\Database\Eloquent\Model;

     class DosenPenelitian extends Model {
         protected $fillable = ['dosen_id', 'penelitian', 'publikasi_karya', 'paten_hki'];
     }