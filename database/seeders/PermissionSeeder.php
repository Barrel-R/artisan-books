<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissoesArray = [
            'ver livros',
            'ver um livro',
            'criar livros',
            'editar livros',
            'deletar livros',
            'ver usuários',
            'ver um usuário',
            'criar usuários',
            'editar usuários',
            'deletar usuários',
            'ver imagens',
            'ver uma imagem',
            'criar imagens',
            'editar imagens',
            'deletar imagens',
            'ver videos',
            'ver um video',
            'criar videos',
            'editar videos',
            'deletar videos',
        ];

        $permissoes = collect($permissoesArray)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        Permission::insert($permissoes->toArray());

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
