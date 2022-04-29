<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('categories.admin');
    }

    public function view(User $user): bool
    {
        return $user->can('categories.admin');
    }

    public function create(User $user): bool
    {
        return $user->can('categories.admin');
    }

    public function update(User $user, Category $category): bool
    {
        return $user->can('categories.admin');
    }

    public function delete(User $user): bool
    {
        return $user->can('categories.admin');
    }
}
