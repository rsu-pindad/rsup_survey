<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Facades\Cache;

class CachedUserProvider extends EloquentUserProvider
{
    public function retrieveById($identifier)
    {
        $cacheKey = 'user_'.$identifier;
        return Cache::remember($cacheKey, now()->addHours(8), function () use ($identifier) {
            return parent::retrieveById($identifier);
        });
    }
}
