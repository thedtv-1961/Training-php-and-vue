<?php

namespace App\Models;

use Storage;
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
}
