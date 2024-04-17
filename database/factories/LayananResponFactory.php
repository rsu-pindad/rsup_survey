<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Layanan;
use App\Models\Respon;
use App\Models\LayananRespon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LayananRespon>
 */
class LayananResponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'layanan_id' => Layanan::factory(),
            'respon_id' => Respon::factory(),
        ];
    }
}
