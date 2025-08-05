<?php

     namespace App\Models;

     use Illuminate\Database\Eloquent\Model;

     class DosenReward extends Model {
         protected $fillable = ['dosen_id', 'beasiswa', 'kesejahteraan', 'tunjangan'];
     }