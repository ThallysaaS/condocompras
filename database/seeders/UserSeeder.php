<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! User::whereEmail('admin@admin.com')->exists()) {
            $admin = User::factory()->create([
                'name' => 'Administrador',
                'email' => 'admin@admin.com',
                'password' => 'admin',
            ]);
            $admin->assignRole('Super Admin');
        }
        if (! User::whereEmail('empresa@empresa.com')->exists()) {
            $admin = User::factory()->create([
                'name' => 'Empresa',
                'email' => 'empresa@empresa.com',
                'password' => 'admin',
            ]);
            $admin->assignRole('Empresa');
        }
        if (! User::whereEmail('sindico@sindico.com')->exists()) {
            $admin = User::factory()->create([
                'name' => 'Administrados',
                'email' => 'sindico@sindico.com',
                'password' => 'admin',
            ]);
            $admin->assignRole('Sindico');
        }
        if (! User::whereEmail('usuario@usuario.com')->exists()) {
            $admin = User::factory()->create([
                'name' => 'Administrados',
                'email' => 'usuario@usuario.com',
                'password' => 'admin',
            ]);
            $admin->assignRole('Usuario');
        };
    }
}
