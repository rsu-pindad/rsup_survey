<?php

namespace Database\Seeders;

use App\Models\LayananRespon;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class LayananResponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // LayananRespon::factory()
        //     ->count(25)
        //     ->create();
        $time = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta');
        try {
            // Penjamin::truncate();
            for ($x = 0; $x <= 20; $x++) {
                $randomLayanan = DB::table('layanan')
                    ->inRandomOrder()
                    ->first();
                $randomRespon = DB::table('respon')
                    ->inRandomOrder()
                    ->first();
                DB::beginTransaction();
                $layananRespon = DB::table('layanan_respon')
                    ->insert([
                        'layanan_id' => $randomLayanan->id,
                        'respon_id' => $randomRespon->id,
                        'created_at' => $time,
                        'updated_at' => $time,
                    ]);
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }
}
