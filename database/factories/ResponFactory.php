<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ResponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_respon' => fake()->word(),
            'icon_respon' => fake()->word(),
            'tag_warna_respon' => fake()->safeHexColor(),
            'skor_respon' => fake()->randomDigit(1, 9)
        ];
    }
}
