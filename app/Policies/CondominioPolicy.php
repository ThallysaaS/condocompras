<?php

namespace App\Policies;

use App\Models\Condominio;
use App\Models\User;

class CondominioPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('listar condominios');
    }

    public function view(User $user, Condominio $role)
    {
        return $user->hasPermissionTo('ver condominios');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('criar condominios');
    }

    public function update(User $user, Condominio $role)
    {
        return $user->hasPermissionTo('atualizar condominios');
    }

    public function delete(User $user, Condominio $role)
    {
        return $user->hasPermissionTo('deletar condominios');
    }
}
