<?php

     namespace App\Models;

     use Illuminate\Foundation\Auth\User as Authenticatable;
     use Spatie\Permission\Traits\HasRoles; // Pastikan ini ada

     class User extends Authenticatable {
         use HasRoles; // Pastikan trait ini digunakan

         protected $fillable = ['name', 'email', 'password', 'role'];

         protected $hidden = ['password', 'remember_token'];

         public function dosenProfile() {
             return $this->hasOne(DosenProfile::class, 'user_id');
         }
     }