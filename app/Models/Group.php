<?php

namespace App\Models;

use App\Models\User;
use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    use Traits\SearchableTrait;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    protected $dates = ['deleted_at'];

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Avatar Accessor
     */
    public function getImage()
    {
        if (!empty($this->attributes['image'])) {
            return '/' . config('groups.image_path') . '/' . $this->attributes['image'];
        }

        return '/' . config('groups.image_default_path');
    }
}
