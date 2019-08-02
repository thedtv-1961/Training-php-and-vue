<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChangeEmailRequest extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'admin_id',
        'status',
        'email_change',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Status Accessor
     */
    public function getStatusAttribute()
    {
        switch ($this->attributes['status']) {
            case config('change_email_requests.status.approved'):
                return trans('change_email_requests.status.approved');
            case config('change_email_requests.status.rejected'):
                return trans('change_email_requests.status.rejected');
            default:
                return trans('change_email_requests.status.pending');
        }
    }
}
