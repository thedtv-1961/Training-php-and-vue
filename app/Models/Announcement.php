<?php

namespace App\Models;

use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'group_id',
        'content',
    ];

    protected $dates = ['deleted_at'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
