<?php

namespace App\Models\Traits;

trait SearchableTrait
{

    /**
     * Scope a query to find records with $atrr like $key.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param Array $attrs
     * @param String $key
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLikeSearch($query, $attrs, $key)
    {
        return $query->where(function ($query) use ($attrs, $key) {
            foreach ($attrs as $attr) {
                $query->orWhere($attr, 'like', '%' . $key . '%');
            }
        });
    }
}
