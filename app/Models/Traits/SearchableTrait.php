<?php

namespace App\Models\Traits;

trait SearchableTrait
{

    /**
     * Scope a query to find records with $atrr like $key.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param String $atrr
     * @param String $key
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLikeSearch($query, $atrr, $key)
    {
        return $query->where($atrr, 'like', '%' . $key . '%');
    }
}
