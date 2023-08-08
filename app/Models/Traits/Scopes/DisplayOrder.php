<?php

namespace App\Models\Traits\Scopes;

/**
 * Scope Display Order
 */
trait DisplayOrder
{
    /**
     * @param $query
     * @param string $direction
     * @return void
     */
    public function scopeDisplayOrder($query, string $direction = 'ASC')
    {
        $query->orderBy('display_order', $direction);
    }

    /**
     * @param $sortOrders
     * @return void
     */
    public static function changeSortOrder($sortOrders)
    {
        foreach ($sortOrders as $sortOrder) {
            $model = self::find($sortOrder['value']);
            if ($model) {
                $model->update(['display_order' => $sortOrder['order']]);
            }
        }
    }
}
