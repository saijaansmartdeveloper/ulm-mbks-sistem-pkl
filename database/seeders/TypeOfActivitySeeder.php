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
            'deskripsi_jenis_kegiatan' => 'Program Kampus Merdeka Untuk Mahasiswa Mengajar'
        ]);

        TypeOfActivity::create([
            'uuid' => Uuid::uuid4(),
            'kode_jenis_kegiatan' => 'PM',
            'nama_jenis_kegiatan' => 'Pertukaran Mahasiswa',
            'deskripsi_jenis_kegiatan' => 'Program Kampus Merdeka Untuk Pertukaran Mahasiswa'
        ]);

        TypeOfActivity::create([
            'uuid' => Uuid::uuid4(),
            'kode_jenis_kegiatan' => 'MAGANG',
            'nama_jenis_kegiatan' => 'Magang',
            'deskripsi_jenis_kegiatan' => 'Program Kampus Merdeka Untuk Magang'
        ]);

        TypeOfActivity::create([
            'uuid' => Uuid::uuid4(),
            'kode_jenis_kegiatan' => 'KT',
            'nama_jenis_kegiatan' => 'Membangun Desa / KKN Tematik',
            'deskripsi_jenis_kegiatan' => 'Program Kampus Merdeka Untuk Membangun Desa atau KKN Tematik'
        ]);

        TypeOfActivity::create([
            'uuid' => Uuid::uuid4(),
            'kode_jenis_kegiatan' => 'PK',
            'nama_jenis_kegiatan' => 'Proyek Kemanusiaan',
            'deskripsi_jenis_kegiatan' => 'Program Kampus Merdeka Untuk Proyek Kemanusiaan'
        ]);

        TypeOfActivity::create([
            'uuid' => Uuid::uuid4(),
            'kode_jenis_kegiatan' => 'RISET',
            'nama_jenis_kegiatan' => 'Riset / Penelitian',
            'deskripsi_jenis_kegiatan' => 'Program Kampus Merdeka Untuk Penelitian atau Riset'
        ]);

        TypeOfActivity::create([
            'uuid' => Uuid::uuid4(),
            'kode_jenis_kegiatan' => 'SI',
            'nama_jenis_kegiatan' => 'Studi Independent',
            'deskripsi_jenis_kegiatan' => 'Program Kampus Merdeka Untuk Studi Independen'
        ]);

        TypeOfActivity::create([
            'uuid' => Uuid::uuid4(),
            'kode_jenis_kegiatan' => 'WIRAUSAHA',
            'nama_jenis_kegiatan' => 'Wirausaha',
            'deskripsi_jenis_kegiatan' => 'Program Kampus Merdeka Untuk Wirausaha'
        ]);

    }
}
