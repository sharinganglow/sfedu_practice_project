<?php

namespace App\Models\Cache;

use Predis\Client;

class RedisCache implements CacheInterface
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function set($key, $value, $id = null): void
    {
        $name = $this->prepareKey($key, $id);
        $this->client->set($name, json_encode($value, JSON_UNESCAPED_UNICODE));
    }

    public function get($key, $id = null): ?array
    {
        $name = $this->prepareKey($key, $id);

        $cachedData = $this->client->exists($name) ? $this->client->get($name) : null;
        if ($cachedData) {
            return json_decode($cachedData, true);
        }

        return null;
    }

    public function delete($key, $id = null): void
    {
        $name = $this->prepareKey($key, $id);

        if ($this->client->exists($name)) {
            $this
                ->client
                ->del($name);
        }
    }

    protected function prepareKey($key, $id): string
    {
        return $key . (isset($id) ? "_{$id}" : 's_list');
    }
}