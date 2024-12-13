<?php

namespace App\Policies;

use App\Models\Produto;
use App\Models\User;

class ProductPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('listar produtos');
    }

    public function view(User $user, Produto $role)
    {
        return $user->hasPermissionTo('ver produtos');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('criar produtos');
    }

    public function update(User $user, Produto $role)
    {
        return $user->hasPermissionTo('atualizar produtos');
    }

    public function delete(User $user, Produto $role)
    {
        return $user->hasPermissionTo('deletar produtos');
    }
}
