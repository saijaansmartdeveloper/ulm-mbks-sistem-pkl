<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Partner::factory()->count(10)->create()->each(function ($user) {
            $user->assignRole('partner');
        });;;

    }
}
