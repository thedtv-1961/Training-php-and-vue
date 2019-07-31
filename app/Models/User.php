<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthday',
        'gender',
        'phone',
        'avatar',
        'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function getGenderAttribute()
    {
        switch ($this->attributes['gender']) {
            case config('users.gender.male'):
                return trans('user.variable.gender.male');
            case config('users.gender.female'):
                return trans('user.variable.gender.female');
            default:
                return trans('user.variable.gender.other_gender');
        }
    }

    public function getAvatarAttribute()
    {
        if ($this->attributes['avatar']) {
            return '/' . config('users.avatar_path') . '/' . $this->attributes['avatar'];
        }
        return '/' . config('users.avatar_path') . '/' . config('user.avatar_default');
    }
}













