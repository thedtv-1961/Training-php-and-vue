<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user is administrator
     * 
     * @param  User  $user
     * 
     * @return bool
     */
    public function before(User $user)
    {
        if ($user->hasRole(config('users.roles.admin'))) {
            return true;
        }
    }

    /**
     * Determine whether the user can update profile.
     *
     * @param  User  $user
     * @param  User  $guest
     * 
     * @return bool
     */
    public function updateProfile(User $user, User $guest)
    {
        return $user->id === $guest->id;
    }

    /**
     * Determine whether the user can approve change email request.
     * 
     * @param  User  $user
     * 
     * @return bool
     */
    public function approveChangeEmail(User $user, User $guest)
    {
        return $guest->hasRole(config('users.roles.admin'));
    }
}
