<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'student', 'name' => 'create jurnal']);
        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'student', 'name' => 'modify jurnal']);
        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'student', 'name' => 'print jurnal']);
        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'student', 'name' => 'upload jurnal']);

        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'lecturer', 'name' => 'verify jurnal']);
        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'lecturer', 'name' => 'modify jurnal']);
        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'lecturer', 'name' => 'manage monev']);

        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'partner', 'name' => 'verify jurnal']);
        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'partner', 'name' => 'modify jurnal']);

        Role::create(['id' => Uuid::uuid4(),'name' => 'Lecturer', 'guard_name' => 'lecturer'])
            ->givePermissionTo(['verify jurnal', 'modify jurnal', 'manage monev']);
        Role::create(['id' => Uuid::uuid4(),'name' => 'Student', 'guard_name' => 'student'])
            ->givePermissionTo(['create jurnal', 'upload jurnal', 'modify jurnal', 'print jurnal']);
        Role::create(['id' => Uuid::uuid4(),'name' => 'Partner', 'guard_name' => 'partner'])
            ->givePermissionTo(['verify jurnal', 'modify jurnal']);



    }
}
