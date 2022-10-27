<?php

namespace App\Models\Cache;

use App\Models\Exceptions\CacheException;

class FileCache implements CacheInterface
{
    private const BASE_PATH = APP_ROOT . '/var/cache/';

    public function set($key, $value, $id = null): void
    {
        $path = $this->getPath($key, $id);
        file_put_contents($path, json_encode($value, JSON_UNESCAPED_UNICODE));
    }

    public function get($key, $id = null): ?array
    {
        $cacheFile = $this->getPath($key, $id);

        $cachedData = file_exists($cacheFile) ? file_get_contents($cacheFile) : null;
        if ($cachedData) {
            return json_decode($cachedData, true);
        }
        return null;
    }

    public function delete($key, $id = null)
    {
        $path = $this->getPath($key, $id);
        unlink($path);
    }

    protected function getPath($key, $id): string
    {
        return isset($id) ?
            self::BASE_PATH . $key . "_{$id}" . '.json' :
            self::BASE_PATH . $key . '.json';
    }
}