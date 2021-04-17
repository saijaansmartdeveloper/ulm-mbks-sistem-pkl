<?php

namespace Database\Factories;

use App\Models\Mitra;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class MitraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mitra::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid'                      => Uuid::uuid4(),
            'nama_mitra'                => $this->faker->company,
            'divisi_mitra'              => $this->faker->companySuffix,
            'alamat_mitra'              => $this->faker->address,
            'penanggung_jawab_mitra'    => $this->faker->name,
            'pamong_mitra'              => $this->faker->name,
            'email'                     => $this->faker->companyEmail,
            'username'                  => $this->faker->firstName,
            'password'                  => Hash::make('secret'),
            'phone'                     => $this->faker->phoneNumber
        ];
    }
}
