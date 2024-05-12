<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [ 
            'dashboard',
            'master-data',
            'departement-list',
            'departement-create',
            'departement-edit',
            'departement-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'profile',
            'profile-edit',
            'data-siswa',
            'data-absensi',
            'absensi',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
