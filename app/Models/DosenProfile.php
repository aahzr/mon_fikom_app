<?php

     namespace App\Models;

     use Illuminate\Database\Eloquent\Model;

     class DosenProfile extends Model {
         protected $fillable = ['user_id', 'nip', 'nama', 'jabatan', 'pangkat', 'penempatan'];

         public function user() {
             return $this->belongsTo(User::class);
         }

         public function kualifikasi() {
             return $this->hasOne(DosenKualifikasi::class, 'dosen_id');
         }

         public function pendidikan() {
             return $this->hasOne(DosenPendidikan::class, 'dosen_id');
         }

         public function penelitian() {
             return $this->hasOne(DosenPenelitian::class, 'dosen_id');
         }

         public function pengabdian() {
             return $this->hasOne(DosenPengabdian::class, 'dosen_id');
         }

         public function penunjang() {
             return $this->hasOne(DosenPenunjang::class, 'dosen_id');
         }

         public function reward() {
             return $this->hasOne(DosenReward::class, 'dosen_id');
         }

         public function proposals() {
             return $this->hasMany(Proposal::class, 'dosen_id');
         }

         public function laporans() {
             return $this->hasMany(Laporan::class, 'dosen_id');
         }

         public function luarans() {
             return $this->hasMany(Luaran::class, 'dosen_id');
         }

         public function keuangans() {
             return $this->hasMany(Keuangan::class, 'dosen_id');
         }
     }