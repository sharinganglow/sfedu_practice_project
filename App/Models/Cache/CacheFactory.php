<?php

namespace App\Models\Cache;

use App\Models\Exceptions\CacheException;

class CacheFactory
{
    public function getObject(string $method): CacheInterface
    {
        switch ($method) {
            case 'file' :
            {
                return new FileCache();
            }
            case 'predis' :
            {
                return new PredisCache();
            }
            default :
            {
                throw new CacheException('Неверно указан метод кэширования');
            }
        }
    }
}