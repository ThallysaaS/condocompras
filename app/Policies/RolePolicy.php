<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('listar roles');
    }

    public function view(User $user, Role $role)
    {
        return $user->hasPermissionTo('ver roles');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('criar roles');
    }

    public function update(User $user, Role $role)
    {
        return $user->hasPermissionTo('atualizar roles');
    }

    public function delete(User $user, Role $role)
    {
        return $user->hasPermissionTo('deletar roles');
    }
}
