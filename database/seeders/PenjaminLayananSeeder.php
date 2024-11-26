<?php

namespace Database\Seeders;

use App\Models\PenjaminLayanan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjaminLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta');

        try {
            // PenjaminLayanan::truncate();
            for ($x = 0; $x <= 100; $x++) {
                $randomLayanan = DB::table('layanan')
                                     ->inRandomOrder()
                                     ->first();
                $randomPenjamin = DB::table('penjamin')
                                      ->inRandomOrder()
                                      ->first();
                DB::beginTransaction();
                $penjaminLayanan = DB::table('penjamin_layanan')
                                       ->insert([
                                           'layanan_id'  => $randomLayanan->id,
                                           'penjamin_id' => $randomPenjamin->id,
                                           'created_at'  => $time,
                                           'updated_at'  => $time,
                                       ]);
                DB::commit();
            }
        } catch (\Throwable $th) {
            // Log::debug($th->getMessage());
            DB::rollback();
        }
    }
}
