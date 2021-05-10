<?php

namespace Database\Seeders;

use App\Models\TypeOfActivity;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class TypeOfActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeOfActivity::create([
            'uuid' => Uuid::uuid4(),
            'kode_jenis_kegiatan' => 'KM',
            'nama_jenis_kegiatan' => 'Kampus Mengajar',
            'deskripsi_jenis_kegiatan' => 'Program Kampus Merdeka Untuk Student Mengajar'
        ]);
    }
}
