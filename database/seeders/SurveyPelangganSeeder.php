<?php

namespace Database\Seeders;

use App\Models\SurveyPelanggan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SurveyPelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta');
        // dd($time);
        try {
            // SurveyPelanggan::truncate();
            for ($x = 0; $x <= 100; $x++) {
                $selectKaryawanProfile = DB::table('karyawanprofile')
                                             ->inRandomOrder()
                                             ->first();
                // dd($selectKaryawanProfile);
                $selectUnit = DB::table('unit')
                                  ->where('id', $selectKaryawanProfile->unit_id)
                                  ->first();
                // dd($selectUnit);
                $selectPenjamin = DB::table('penjamin')
                                      ->where('unit_id', $selectUnit->id)
                                      ->inRandomOrder()
                                      ->first();
                // dd($selectPenjamin);
                $selectPenjaminLayanan = DB::table('penjamin_layanan')
                                             ->where('penjamin_id', $selectPenjamin->id)
                                             ->inRandomOrder()
                                             ->first();
                // dd($selectPenjaminLayanan);
                DB::beginTransaction();
                $surveyPelanggan = DB::table('survey_pelanggan')
                                       ->insert([
                                           'karyawan_id'         => $selectKaryawanProfile->id,
                                           'penjamin_layanan_id' => $selectPenjaminLayanan->id,
                                           'nama_pelanggan'      => fake()->word(),
                                           'handphone_pelanggan' => fake()->unique()->phoneNumber(),
                                           'shift'               => fake()->randomDigit(0, 2),
                                           'nilai_skor'          => fake()->randomDigit(1, 4),
                                           'created_at'          => $time,
                                           'updated_at'          => $time,
                                       ]);
                DB::commit();
            }
        } catch (\Throwable $th) {
            // Log::debug($th->getMessage());
            DB::rollback();
        }
    }
}
