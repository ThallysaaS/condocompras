<?php

namespace App\Policies;

use App\Models\Empresa;
use App\Models\User;

class EmpresaPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('listar empresas');
    }

    public function view(User $user, Empresa $role)
    {
        return $user->hasPermissionTo('ver empresas');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('criar empresas');
    }

    public function update(User $user, Empresa $role)
    {
        return $user->hasPermissionTo('atualizar empresas');
    }

    public function delete(User $user, Empresa $role)
    {
        return $user->hasPermissionTo('deletar empresas');
    }
}
