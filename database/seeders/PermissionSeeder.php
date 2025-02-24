<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::query()->truncate();
        $permissions = [
            ['name' => 'listar user', 'guard_name' => 'web'],
            ['name' => 'ver user', 'guard_name' => 'web'],
            ['name' => 'criar user', 'guard_name' => 'web'],
            ['name' => 'atualizar user', 'guard_name' => 'web'],
            ['name' => 'deletar user', 'guard_name' => 'web'],
            ['name' => 'listar empresas', 'guard_name' => 'web'],
            ['name' => 'ver empresas', 'guard_name' => 'web'],
            ['name' => 'criar empresas', 'guard_name' => 'web'],
            ['name' => 'atualizar empresas', 'guard_name' => 'web'],
            ['name' => 'deletar empresas', 'guard_name' => 'web'],
            ['name' => 'listar produtos', 'guard_name' => 'web'],
            ['name' => 'ver produtos', 'guard_name' => 'web'],
            ['name' => 'criar produtos', 'guard_name' => 'web'],
            ['name' => 'atualizar produtos', 'guard_name' => 'web'],
            ['name' => 'deletar produtos', 'guard_name' => 'web'],
            ['name' => 'listar servicos', 'guard_name' => 'web'],
            ['name' => 'ver servicos', 'guard_name' => 'web'],
            ['name' => 'criar servicos', 'guard_name' => 'web'],
            ['name' => 'atualizar servicos', 'guard_name' => 'web'],
            ['name' => 'deletar servicos', 'guard_name' => 'web'],
            ['name' => 'listar condominios', 'guard_name' => 'web'],
            ['name' => 'ver condominios', 'guard_name' => 'web'],
            ['name' => 'criar condominios', 'guard_name' => 'web'],
            ['name' => 'atualizar condominios', 'guard_name' => 'web'],
            ['name' => 'deletar condominios', 'guard_name' => 'web'],
            ['name' => 'listar roles', 'guard_name' => 'web'],
            ['name' => 'ver roles', 'guard_name' => 'web'],
            ['name' => 'criar roles', 'guard_name' => 'web'],
            ['name' => 'atualizar roles', 'guard_name' => 'web'],
            ['name' => 'deletar roles', 'guard_name' => 'web'],
        ];
        Permission::insert($permissions);
    }
}
