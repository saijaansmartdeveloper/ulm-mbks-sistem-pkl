<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolePermissionSeeder::class);
        $this->call(UsersSeeder::class);

        $this->call(MajorSeeder::class);
        $this->call(TypeOfActivitySeeder::class);

//        $this->call(LecturerSeeder::class);
//        $this->call(StudentSeeder::class);
//        $this->call(MitraSeeder::class);
    }
}
