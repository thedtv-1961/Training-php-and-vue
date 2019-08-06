<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
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
     * Determine whether the user can update the description of group.
     *
     * @param  User  $user
     * @param  Group  $group
     * 
     * @return bool
     */
    public function updateDescription(User $user, Group $group)
    {
        return $user->hasRole(config('users.roles.group_manager')) && in_array($group->id, $user->group_ids);
    }

    /**
     * Determine whether the user can add new member to group.
     *
     * @param  User  $user
     * @param  Group  $group
     * 
     * @return bool
     */
    public function addMember(User $user, Group $group)
    {
        return $user->hasRole(config('users.roles.group_manager')) && in_array($group->id, $user->group_ids);
    }

    /**
     * Determine whether the user delete member from group.
     *
     * @param  User  $user
     * @param  Group  $group
     * 
     * @return bool
     */
    public function deleteMember(User $user, Group $group)
    {
        return $user->hasRole(config('users.roles.group_manager')) && in_array($group->id, $user->group_ids);
    }
}
