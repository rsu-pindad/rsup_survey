<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // User
        // Karyawan
        // Unit
        // KaryawanProfile

        // Penjamin
        // Layanan

        // Respon
        //

        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            KaryawanSeeder::class,
            UnitSeeder::class,
            LayananSeeder::class,
            KaryawanProfileSeeder::class,
        ]);
        $this->call([
            PenjaminSeeder::class,
        ]);
        $this->call([
            ResponSeeder::class,
            LayananResponSeeder::class,
            PenjaminLayananSeeder::class
        ]);
        $this->call([
            SurveyPelangganSeeder::class,
        ]);
    }
}
