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

        $name = isset($id) ? $key . "_{$id}" : $key . 's_list';
        foreach ($value as $i => $row) {
            $this->client->hset($name, $i, json_encode($row, JSON_UNESCAPED_UNICODE));
        }
    }

    public function get($key, $id = null): ?array
    {
        $name = isset($id) ? $key . "_{$id}" : $key . 's_list';

        $cachedData = $this->client->exists($name) ? $this->client->hgetall($name) : null;
        if ($cachedData) {
            if (!is_array(reset($cachedData))) {
                return json_decode($cachedData, true);
            }
            $result = [];
            foreach ($cachedData as $row) {
                $result [] = json_decode($row, true);
            }
            return $result;
        }

        return null;
    }

    public function delete($key, $id = null): void
    {
        $name = isset($id) ? $key . "_{$id}" : $key . 's_list';

        if ($this->client->exists($name)) {
            $this
                ->client
                ->del($name);
        }
    }
}