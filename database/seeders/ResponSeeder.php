<?php

namespace Database\Seeders;

use App\Models\Respon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Respon::factory()
            ->count(4)
            ->create();
    }
}
