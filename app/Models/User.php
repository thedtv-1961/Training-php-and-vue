<?php

namespace App\Models;

use Storage;
use App\Models\Role;
use App\Models\Group;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender',
        'avatar',
        'address',
        'birthday',
        'password',
        'reset_token',
        'reset_token_expires_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * Gender Accessor
     */
    public function getGenderAttribute()
    {
        if (empty($this->attributes['gender'])) {
            return null;
        }

        switch ($this->attributes['gender']) {
            case config('users.gender.male'):
                return trans('user.variable.gender.male');
            case config('users.gender.female'):
                return trans('user.variable.gender.female');
            default:
                return trans('user.variable.gender.other_gender');
        }
    }

    /**
     * Avatar Accessor
     */
    public function getAvatarAttribute()
    {
        if (!empty($this->attributes['avatar'])) {
            return Storage::url($this->attributes['avatar']);
        }

        return '/' . config('users.avatar_default_path');
    }

    /**
     * Set password mutator
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /*
     *  Define roles relationship
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get group_ids attributes
     */
    public function getGroupIdsAttribute()
    {
        return $this->groups->pluck('id')->all();
    }

    /**
     * Determine if the user has a role.
     *
     * @param string $roleSlug
     *
     * @return bool
     */
    public function hasRole($roleSlug)
    {
        foreach ($this->roles as $role) {
            if ($role->slug == $roleSlug) {
                return true;
            }
        }

        return false;
    }
}
