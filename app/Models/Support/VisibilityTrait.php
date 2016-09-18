<?php

namespace App\Models\Support;

trait VisibilityTrait
{
    /**
     * Scope to include visible results only.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', 1);
    }
}
