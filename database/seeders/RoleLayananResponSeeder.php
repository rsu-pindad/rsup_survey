<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleLayananResponSeeder extends Seeder
{
    private $permissions = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
        'layanan-respon-list',
        'layanan-respon-create',
        'layanan-respon-edit',
        'layanan-respon-delete'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        Role::truncate();
        // DB::statement('ALTER TABLE role_has_permissions;');
        // DB::statement('ALTER TABLE model_has_roles;');
        // DB::statement('ALTER TABLE model_has_permissions;');
        // DB::statement('ALTER TABLE roles;');
        // DB::statement('ALTER TABLE permissions;');
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $user = User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('12345'),  // password
            // 'roles' => 'admin',
            'remember_token' => Str::random(10),
        ]);
        $role = Role::create(['name' => 'admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
