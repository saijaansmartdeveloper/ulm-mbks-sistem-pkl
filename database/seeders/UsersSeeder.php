<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::create([
            'uuid'          => Uuid::uuid4(),
            'nama_pengguna' => 'super_admin',
            'email'         => 'superadmin@admin.com',
            'password'      => bcrypt('secret'),
            'role_pengguna' => 'super_admin'
        ]);

        $super_admin->assignRole('super_admin');

    }
}
