<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('listar user');
    }

    public function view(User $user, User $role)
    {
        return $user->hasPermissionTo('ver user');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('criar user');
    }

    public function update(User $user, User $role)
    {
        return $user->hasPermissionTo('atualizar user');
    }

    public function delete(User $user, User $role)
    {
        return $user->hasPermissionTo('deletar user');
    }
}
