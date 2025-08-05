<?php

      namespace Database\Seeders;

      use Illuminate\Database\Seeder;
      use Spatie\Permission\Models\Role;
      use Spatie\Permission\Models\Permission;

      class RolePermissionSeeder extends Seeder {
          public function run(): void {
              $roles = ['dosen', 'mahasiswa', 'koordinator_prodi', 'koordinator_litabmas', 'fakultas', 'admin_fakultas', 'reviewer'];
              foreach ($roles as $role) {
                  Role::create(['name' => $role]);
              }

              $permissions = [
                  'input-proposal', 'input-laporan', 'input-luaran', 'input-keuangan',
                  'view-profile', 'view-kualifikasi', 'view-pendidikan', 'view-penelitian',
                  'view-pengabdian', 'view-penunjang', 'view-reward', 'validate-activity',
                  'manage-users', 'backup-system', 'generate-report'
              ];
              foreach ($permissions as $permission) {
                  Permission::create(['name' => $permission]);
              }

              $dosenRole = Role::where('name', 'dosen')->first();
              $dosenRole->givePermissionTo(['input-proposal', 'input-laporan', 'input-luaran', 'input-keuangan', 'view-profile', 'view-kualifikasi', 'view-pendidikan', 'view-penelitian', 'view-pengabdian', 'view-penunjang', 'view-reward']);
          }
      }