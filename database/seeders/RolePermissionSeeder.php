<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use MongoDB\BSON\Persistable;
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
        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'student', 'name' => 'create jurnal mahasiswa']);
        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'student', 'name' => 'modify jurnal mahasiswa']);
        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'student', 'name' => 'print jurnal mahasiswa']);
        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'student', 'name' => 'upload jurnal mahasiswa']);

        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'lecturer', 'name' => 'verify jurnal dosen']);
        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'lecturer', 'name' => 'modify jurnal dosen']);
        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'lecturer', 'name' => 'manage monev dosen']);

        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'partner', 'name' => 'verify jurnal mitra']);
        Permission::create(['id' => Uuid::uuid4(),'guard_name' => 'partner', 'name' => 'modify jurnal mitra']);

        Permission::create(['id' => Uuid::uuid4(), 'guard_name' => 'web', 'name' => 'manage dosen']);
        Permission::create(['id' => Uuid::uuid4(), 'guard_name' => 'web', 'name' => 'manage mahasiswa']);
        Permission::create(['id' => Uuid::uuid4(), 'guard_name' => 'web', 'name' => 'manage mitra']);
        Permission::create(['id' => Uuid::uuid4(), 'guard_name' => 'web', 'name' => 'manage jenis kegiatan']);
        Permission::create(['id' => Uuid::uuid4(), 'guard_name' => 'web', 'name' => 'manage kegiatan']);
        Permission::create(['id' => Uuid::uuid4(), 'guard_name' => 'web', 'name' => 'look data']);

        Role::create(['id' => Uuid::uuid4(), 'name' => 'super_admin', 'guard_name'  => 'web']);
        Role::create(['id' => Uuid::uuid4(), 'name' => 'admin_prodi', 'guard_name'  => 'web']);
        Role::create(['id' => Uuid::uuid4(), 'name' => 'suvervisor', 'guard_name'  => 'web']);
        Role::create(['id' => Uuid::uuid4(), 'name' => 'lecturer', 'guard_name' => 'lecturer']);
        Role::create(['id' => Uuid::uuid4(), 'name' => 'student', 'guard_name' => 'student']);
        Role::create(['id' => Uuid::uuid4(), 'name' => 'partner', 'guard_name' => 'partner']);

    }
}
