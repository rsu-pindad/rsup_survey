<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UnitProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta');
        try {
            $randomUnit = DB::table('unit')
                ->inRandomOrder()
                ->first();
            // dd($randomUnit);
            DB::beginTransaction();
            $unitProfil = DB::table('unit_profil')
                ->insert([
                    'unit_id' => $randomUnit->id,
                    'unit_main_logo' => fake()->word(),
                    'unit_sub_logo' => fake()->word(),
                    'unit_alamat' => fake()->word(),
                    'unit_motto' => fake()->word(),
                    'created_at' => $time,
                    'updated_at' => $time,
                ]);
            // dd($unitProfil);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }
}
