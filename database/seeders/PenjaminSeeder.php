<?php

namespace Database\Seeders;

use App\Models\Penjamin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenjaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Penjamin::factory()
            ->count(4)
            ->create();
    }
}
