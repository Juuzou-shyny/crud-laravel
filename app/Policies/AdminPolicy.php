<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{

    public function before(User $user, string $ability): bool|null
    {
        return $user->role === 'admin' ? true : null;
    }
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
}
