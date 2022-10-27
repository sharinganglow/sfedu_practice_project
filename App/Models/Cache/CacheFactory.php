<?php

namespace App\Models\Cache;

use App\Models\Environment\Environment;
use App\Models\Exceptions\CacheException;

class CacheFactory
{
    public function getObject(): CacheInterface
    {
        $method = $this->defineMethod();
        $cacheMap = [
            'file' => FileCache::class,
            'redis' => RedisCache::class
        ];

        $cache = new $cacheMap[$method] ?? null;
        if (!$cache) {
            throw new CacheException('Неверно указан метод кэширования');
        }

        return $cache;
    }

    protected function defineMethod(): string
    {
        return Environment::checkInstance()->getCacheMethod();
    }
}