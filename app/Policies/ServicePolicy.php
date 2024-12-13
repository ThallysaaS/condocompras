<?php

namespace App\Policies;

use App\Models\Servico;
use App\Models\User;

class ServicePolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('listar servicos');
    }

    public function view(User $user, Servico $role)
    {
        return $user->hasPermissionTo('ver servicos');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('criar servicos');
    }

    public function update(User $user, Servico $role)
    {
        return $user->hasPermissionTo('atualizar servicos');
    }

    public function delete(User $user, Servico $role)
    {
        return $user->hasPermissionTo('deletar servicos');
    }
}
