<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\StudyProgram;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // JURUSAN
        $jmipa = Major::create([
            'uuid' => Uuid::uuid4(),
            'kode_jurusan' => 'PMIPA',
            'nama_jurusan' => 'Pendidikan Matematika dan Ilmu Pengetahuan Alam'
        ]);

        $jip = Major::create([
            'uuid' => Uuid::uuid4(),
            'kode_jurusan' => 'IP',
            'nama_jurusan' => 'Ilmu Pendidikan'
        ]);

        // PRODI
        StudyProgram::create([
            'uuid' => Uuid::uuid4(),
            'kode_prodi' => 'TEKPEN',
            'nama_prodi' => 'Teknologi Pendidikan',
            'jurusan_uuid' => $jip->uuid
        ]);

        StudyProgram::create([
            'uuid' => Uuid::uuid4(),
            'kode_prodi' => 'PKH',
            'nama_prodi' => 'Pendidikan Khusus',
            'jurusan_uuid' => $jip->uuid
        ]);

        StudyProgram::create([
            'uuid' => Uuid::uuid4(),
            'kode_prodi' => 'BK',
            'nama_prodi' => 'Pendidikan Konseling',
            'jurusan_uuid' => $jip->uuid
        ]);

        StudyProgram::create([
            'uuid' => Uuid::uuid4(),
            'kode_prodi' => 'PILKOM',
            'nama_prodi' => 'Pendidikan Komputer',
            'jurusan_uuid' => $jmipa->uuid
        ]);

        StudyProgram::create([
            'uuid' => Uuid::uuid4(),
            'kode_prodi' => 'PMTK',
            'nama_prodi' => 'Pendidikan Matematika',
            'jurusan_uuid' => $jmipa->uuid
        ]);

        StudyProgram::create([
            'uuid' => Uuid::uuid4(),
            'kode_prodi' => 'PKIMIA',
            'nama_prodi' => 'Pendidikan Kimia',
            'jurusan_uuid' => $jmipa->uuid
        ]);

        StudyProgram::create([
            'uuid' => Uuid::uuid4(),
            'kode_prodi' => 'PFISIKA',
            'nama_prodi' => 'Pendidikan Fisika',
            'jurusan_uuid' => $jmipa->uuid
        ]);

        StudyProgram::create([
            'uuid' => Uuid::uuid4(),
            'kode_prodi' => 'PBIO',
            'nama_prodi' => 'Pendidikan Biologi',
            'jurusan_uuid' => $jmipa->uuid
        ]);

        StudyProgram::create([
            'uuid' => Uuid::uuid4(),
            'kode_prodi' => 'PIPA',
            'nama_prodi' => 'Pendidikan Ilmu Pengetahuan Alam',
            'jurusan_uuid' => $jmipa->uuid
        ]);

    }
}
