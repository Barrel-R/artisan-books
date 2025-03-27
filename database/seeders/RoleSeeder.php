<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            ['name' => 'Admin', 'guard_name' => 'web'],
            ['name' => 'Cliente', 'guard_name' => 'web'],
        ];

        Role::insert($roles);

        $permissionsByRole = [
            'Cliente' => [
                'ver livros',
                'ver um livro',
                'ver videos',
                'ver um video',
                'ver imagens',
                'ver uma imagem',
            ],
        ];

        foreach ($permissionsByRole as $roleName => $permissions) {
            $role = Role::where('name', $roleName)->first();

            $role->givePermissionTo([$permissions]);
        }

        Role::where('name', 'Admin')->first()->givePermissionTo(Permission::all());

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
