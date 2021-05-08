<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use function Sodium\increment;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid'              => Uuid::uuid4(),
            'nim_mahasiswa'     => $this->faker->randomDigit,
            'nama_mahasiswa'    => $this->faker->name,
            'email'             => $this->faker->email,
            'password'          => Hash::make('secret'),
            'phone'             => $this->faker->phoneNumber,
            'prodi_uuid'        => null,
            'jurusan_uuid'      => null
        ];
    }
}
