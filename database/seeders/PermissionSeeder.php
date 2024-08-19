<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $name = fake()->word();
        $permission = Permission::updateOrCreate(
            ['name' => $name],
            ['name' => $name]
        );

        $permissionRandom = Permission::find($permission->id);
        $idRole = fake()->randomDigit(1);
        $role = Role::find(1);
        $role->givePermissionTo($permissionRandom);

        $idUser = fake()->randomDigit(1);
        $user = User::find(1);
        $user->assignRole($role->id);
    }
}
