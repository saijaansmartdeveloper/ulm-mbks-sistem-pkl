<?php

namespace Database\Seeders;

use App\Models\JenisKegiatan;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class JenisKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisKegiatan::create([
            'uuid' => Uuid::uuid4(),
            'kode_jenis_kegiatan' => 'KM',
            'nama_jenis_kegiatan' => 'Kampus Mengajar',
            'deskripsi_jenis_kegiatan' => 'Program Kampus Merdeka Untuk Mahasiswa Mengajar'
        ]);
    }
}
