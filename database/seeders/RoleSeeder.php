<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    public function run()
    {

      DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Role::query()->truncate();
        $permissions = Permission::all()->pluck('name')->toArray();

        Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ])->givePermissionTo($permissions);

         Role::create([
        'name' => 'Empresa',
        'guard_name' => 'web',
         ])->givePermissionTo([
            'listar empresas',
            'ver empresas',
            'criar empresas',
            'atualizar empresas',
            'deletar empresas',
            'listar servicos',
            'ver servicos',
            'criar servicos',
            'atualizar servicos',
            'deletar servicos',
         ]);

         Role::create([
            'name' => 'Sindico',
            'guard_name' => 'web',
         ])->givePermissionTo([
            'listar condominios',
            'ver condominios',
            'criar condominios',
            'atualizar condominios',
            'deletar condominios',
            'listar empresas',
            'ver empresas',
            'criar empresas',
            'atualizar empresas',
            'deletar empresas',
            'listar servicos',
            'ver servicos',
            'criar servicos',
            'atualizar servicos',
            'deletar servicos',
            'listar produtos',
            'ver produtos',
            'criar produtos',
            'atualizar produtos',
            'deletar produtos',
            'listar user',
            'ver user',
            'criar user',
            'atualizar user',
            'deletar user',
         ]);

         Role::create([
            'name' => 'Usuario',
            'guard_name' => 'web',
         ])->givePermissionTo([
            'listar condominios',
            'ver condominios',
            'criar condominios',
            'atualizar condominios',
            'deletar condominios',
            'listar empresas',
            'ver empresas',
            'criar empresas',
            'atualizar empresas',
            'deletar empresas',
            'listar servicos',
            'ver servicos',
            'criar servicos',
            'atualizar servicos',
            'deletar servicos',
            'listar produtos',
            'ver produtos',
            'criar produtos',
            'atualizar produtos',
            'deletar produtos',
         ]);
    }
}
