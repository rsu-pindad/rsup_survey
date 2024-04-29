<?php

namespace Database\Seeders;

use App\Models\SurveyPelanggan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use DB;

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
            for ($x = 0; $x <= 1000; $x++) {
                $randomUser = DB::table('users')
                    // ->inRandomOrder()
                    ->where('id', 1)
                    ->first();
                // dd($randomUser->id);
                // Log::debug($randomUser);
                DB::beginTransaction();
                $selectKaryawanProfile = DB::table('karyawanprofile')
                    ->where('user_id', $randomUser->id)
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
                $surveyPelanggan = DB::table('survey_pelanggan')
                    ->insert([
                        'karyawan_id' => $selectKaryawan->id,
                        'penjamin_layanan_id' => $selectPenjaminLayanan->id,
                        'nama_pelanggan' => fake()->word(),
                        'handphone_pelanggan' => fake()->unique()->phoneNumber(),
                        'shift' => fake()->randomDigit(0, 2),
                        'nilai_skor' => fake()->randomDigit(1, 4),
                        'created_at' => $time,
                        'updated_at' => $time,
                    ]);
                // dd($surveyPelanggan);
                DB::commit();
                Log::debug($surveyPelanggan);
            }
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            DB::rollback();
        }
    }
}
