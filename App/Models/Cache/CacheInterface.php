<?php

namespace App\Models\Cache;

interface CacheInterface
{
    public function set($key, $value, $id = null);

    public function get($key, $id = null);

    public function delete($key, $id = null);
}