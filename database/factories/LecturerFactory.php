<?php

namespace Database\Factories;

use App\Models\Lecturer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class LecturerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lecturer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid'          => Uuid::uuid4()->toString(),
            'nip_dosen'     => '0',
            'nama_dosen'    => $this->faker->name,
            'email'         => $this->faker->email,
            'password'      => Hash::make('secret'),
            'prodi_uuid'    => null,
            'jurusan_uuid'  => null
        ];
    }
}
