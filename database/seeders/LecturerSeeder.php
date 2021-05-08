<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use Illuminate\Database\Seeder;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lecturer::factory()->count(10)->create()->each(function ($user) {
            $user->assignRole('lecturer');
        });;
    }
}
