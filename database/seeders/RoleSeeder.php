<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role::factory()
        //     ->count(3)
        //     ->create();
        $name = fake()->word();
        Role::updateOrCreate(
            ['name' => $name],
            ['name' => $name]
        );
        Role::updateOrCreate(
            ['name' => 'employee'],
            ['name' => 'employee']
        );
        Role::updateOrCreate(
            ['name' => 'sdm'],
            ['name' => 'sdm']
        );
        Role::updateOrCreate(
            ['name' => 'direksi'],
            ['name' => 'direksi']
        );
    }
}
