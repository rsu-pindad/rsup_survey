<?php

namespace Database\Seeders;

use App\Models\KaryawanProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use DB;

class KaryawanProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta');

        try {
            KaryawanProfile::truncate();
            for ($x = 0; $x <= 100; $x++) {
                $randomUser = DB::table('users')
                    ->inRandomOrder()
                    ->first();
                DB::beginTransaction();
                $randomKaryawan = DB::table('karyawan')
                    // ->where('taken', 0)
                    ->inRandomOrder()
                    ->first();
                $affectedRandomKaryawan = DB::table('karyawan')
                    ->where('id', $randomKaryawan->id)
                    ->update([
                        'taken' => 1,
                        'updated_at' => $time,
                    ]);
                $randomUnit = DB::table('unit')
                    ->inRandomOrder()
                    ->first();
                $randomKaryawanProfile = DB::table('karyawanprofile')
                    ->insert([
                        'user_id' => $randomUser->id,
                        'karyawan_id' => $randomKaryawan->id,
                        'unit_id' => $randomUnit->id,
                        'nama_karyawanprofile' => fake()->word(),
                        'created_at' => $time,
                        'updated_at' => $time,
                    ]);
                DB::commit();
            }
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            DB::rollback();
        }
    }
}
