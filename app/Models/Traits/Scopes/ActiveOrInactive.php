<?php

namespace App\Models\Traits\Scopes;

/**
 * Scope Active or Inactive
 */
trait ActiveOrInactive
{
    /**
     * @param $query
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('active', 1);
    }

    /**
     * @param $query
     * @return void
     */
    public function scopeInactive($query)
    {
        $query->where('active', 0);
    }
}
