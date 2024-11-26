<?php

namespace Database\Seeders;

use App\Models\KaryawanProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KaryawanProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta');
        // KaryawanProfile::truncate();
        try {
            for ($x = 0; $x <= 10; $x++) {
                $randomUser = DB::table('users')
                                  ->inRandomOrder()
                                  ->first();
                $randomKaryawan = DB::table('karyawan')
                                      ->where('taken', 0)
                                      ->inRandomOrder()
                                      ->first();
                $randomUnit = DB::table('unit')
                                  ->inRandomOrder()
                                  ->first();
                $randomLayanan = DB::table('layanan')
                                     ->inRandomOrder()
                                     ->first();
                DB::beginTransaction();
                $affectedRandomKaryawan = DB::table('karyawan')
                                              ->where('id', $randomKaryawan->id)
                                              ->update([
                                                  'taken'      => 1,
                                                  'updated_at' => $time,
                                              ]);
                $randomKaryawanProfile = DB::table('karyawanprofile')
                                             ->insert([
                                                 'user_id'              => $randomUser->id,
                                                 'karyawan_id'          => $randomKaryawan->id,
                                                 'unit_id'              => $randomUnit->id,
                                                 'layanan_id'           => $randomLayanan->id,
                                                 'nama_karyawanprofile' => fake()->word(),
                                                 'created_at'           => $time,
                                                 'updated_at'           => $time,
                                             ]);
                DB::commit();
            }
        } catch (\Throwable $th) {
            // Log::info($th);
            DB::rollback();
        }
    }
}
