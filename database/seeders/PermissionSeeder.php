<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'role-list',
                'mock' => 'List',
                'category' => 'Roles',
                'guard_name' => 'web',
                'status' => '1',
            ],
            [
                'name' => 'role-create',
                'mock' => 'Buat',
                'category' => 'Roles',
                'guard_name' => 'web',
                'status' => '1',
            ],
            [
                'name' => 'role-edit',
                'mock' => 'Ubah',
                'category' => 'Roles',
                'guard_name' => 'web',
                'status' => '1',
            ],
            [
                'name' => 'role-delete',
                'mock' => 'Hapus',
                'category' => 'Roles',
                'guard_name' => 'web',
                'status' => '1',
            ],


            [
                'name' => 'permission-list',
                'mock' => 'List',
                'category' => 'Permissions',
                'guard_name' => 'web',
                'status' => '1',
            ],
            [
                'name' => 'permission-create',
                'mock' => 'Buat',
                'category' => 'Permissions',
                'guard_name' => 'web',
                'status' => '1',
            ],
            [
                'name' => 'permission-edit',
                'mock' => 'Ubah',
                'category' => 'Permissions',
                'guard_name' => 'web',
                'status' => '1',
            ],
            [
                'name' => 'permission-delete',
                'mock' => 'Hapus',
                'category' => 'Permissions',
                'guard_name' => 'web',
                'status' => '1',
            ],


            [
                'name' => 'user-list',
                'mock' => 'List',
                'category' => 'Users',
                'guard_name' => 'web',
                'status' => '1',
            ],
            [
                'name' => 'user-create',
                'mock' => 'Buat',
                'category' => 'Users',
                'guard_name' => 'web',
                'status' => '1',
            ],
            [
                'name' => 'user-edit',
                'mock' => 'Ubah',
                'category' => 'Users',
                'guard_name' => 'web',
                'status' => '1',
            ],
            [
                'name' => 'user-delete',
                'mock' => 'Hapus',
                'category' => 'Users',
                'guard_name' => 'web',
                'status' => '1',
            ],


            [
                'name' => 'site-list',
                'mock' => 'List',
                'category' => 'Sites',
                'guard_name' => 'web',
                'status' => '1',
            ],
            [
                'name' => 'site-create',
                'mock' => 'Buat',
                'category' => 'Sites',
                'guard_name' => 'web',
                'status' => '1',
            ],
            [
                'name' => 'site-edit',
                'mock' => 'Ubah',
                'category' => 'Sites',
                'guard_name' => 'web',
                'status' => '1',
            ],
            [
                'name' => 'site-delete',
                'mock' => 'Hapus',
                'category' => 'Sites',
                'guard_name' => 'web',
                'status' => '1',
            ],
        ];

        foreach ($permissions as $permissionData) {
            Permission::create($permissionData);
        }
    }
}