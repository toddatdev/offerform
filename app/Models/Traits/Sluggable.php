<?php

namespace App\Models\Traits;

trait Sluggable
{
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        if (!$this->slug) {
            $this->slug = 's' . uniqid();
        }

        return parent::save();
    }
}
