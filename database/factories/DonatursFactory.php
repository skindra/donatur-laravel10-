<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donaturs>
 */
class DonatursFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $i = fake()->unique()->randomDigit();
        $kode = sprintf("%04d", $i);
        return [
            'kode'=> 'A'.$kode,
            'nama' => fake()->firstNameMale().' '.fake()->lastNameMale(),
            'nama_outlet' => fake()->company(),
            'alamat' => fake()->address(),
            'no_hp' => fake()->phoneNumber(),
            'jenkel' => 'L',
            'status' => '1',
            'map' => '-',
        ];
    }
}
