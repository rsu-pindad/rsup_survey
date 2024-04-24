<?php

namespace Database\Seeders;

use App\Models\Penjamin;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use DB;

class PenjaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta');
        try {
            // Penjamin::truncate();
            for ($x = 0; $x <= 20; $x++) {
                $randomUnit = DB::table('unit')
                    ->inRandomOrder()
                    ->first();
                DB::beginTransaction();
                $penjamin = DB::table('penjamin')
                    ->insert([
                        'unit_id' => $randomUnit->id,
                        'nama_penjamin' => fake()->word(),
                        'created_at' => $time,
                        'updated_at' => $time,
                    ]);
                // Log::info($penjamin);
                // dd($randomUnit);
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }
}
