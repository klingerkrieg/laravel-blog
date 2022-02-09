<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccessPolicy
{
    use HandlesAuthorization;

    public function admin(User $user) {
        return $user->level == User::ADMIN_LEVEL;
    }

}
