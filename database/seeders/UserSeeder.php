<?php

  namespace Database\Seeders;

  use App\Models\User;
  use Spatie\Permission\Models\Role;
  use Illuminate\Database\Seeder;

  class UserSeeder extends Seeder
  {
      public function run()
      {
          $user = User::create([
              'name' => 'Dosen Contoh',
              'email' => 'dosen@example.com',
              'password' => bcrypt('password'),
          ]);

          $role = Role::firstOrCreate(['name' => 'dosen']);
          $user->assignRole($role);
      }
  }