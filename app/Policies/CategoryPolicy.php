<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function manage(User $user, Category $category): bool
    {
        // return $user->id === $category->user_id;
        // return $user->is($category->user);
        return $category->user()->is($user);
    }
}
