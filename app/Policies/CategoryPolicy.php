<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function admin(User $user): bool
    {
        return $user->hasPermission('categories.admin');
    }
}
