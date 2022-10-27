<?php

namespace App\Controllers\Api;

use App\Controllers\AbstractController;
use App\Models\Cache\FileCache;
use App\Models\Environment\Environment;

abstract class AbstractApi extends AbstractController
{
    protected $id;
    protected $cacheModel;
    protected $cacheData;

    public function __construct($id = null)
    {
        $this->id = $id;
        $this->cacheModel = Environment::checkInstance()->getCacheModel();
    }

    public function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function isPut(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'PUT';
    }

    public function isDelete(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'DELETE';
    }

    protected function success(): void
    {
        header('Status: 200');
    }

    public function noRoute(): void
    {
        header('Status: 404');
    }

    public function hasId(): bool
    {
        return isset($this->id);
    }

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function display($data): void
    {
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function decodeJsonRequest()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function getData($fileName, object $service): ?array
    {
        $data = [];
        if (!$data = $this->cacheModel->get($fileName, $this->getId())) {
            $data = $this->getId() ? $service->getUnit($this->getId()) : $service->getAll();
            $this->cacheModel->set($fileName, $data, $this->getId());
        }

        return $data;
    }
}