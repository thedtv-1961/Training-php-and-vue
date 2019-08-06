<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Announcement;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncementPolicy
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
     * Determine whether the user can view the announcement.
     *
     * @param  User  $user
     * @param  Announcement  $announcement
     * 
     * @return bool
     */
    public function view(User $user, Announcement $announcement)
    {
        return $user->hasRole(config('users.roles.group_manager'));
    }

    /**
     * Determine whether the user can create announcements.
     *
     * @param  User  $user
     * 
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasRole(config('users.roles.group_manager'));
    }

    /**
     * Determine whether the user can update the announcement.
     *
     * @param  User  $user
     * @param  Announcement  $announcement
     * 
     * @return bool
     */
    public function update(User $user, Announcement $announcement)
    {
        return $user->hasRole(config('users.roles.group_manager')) && in_array($announcement->group_id, $user->group_ids);
    }

    /**
     * Determine whether the user can delete the announcement.
     *
     * @param  User  $user
     * @param  Announcement  $announcement
     * 
     * @return bool
     */
    public function delete(User $user, Announcement $announcement)
    {
        return $user->hasRole(config('users.roles.group_manager')) && in_array($announcement->group_id, $user->group_ids);
    }
}
