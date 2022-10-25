<?php

namespace App\Controllers\Api;

use App\Controllers\AbstractController;
use App\Models\Entity\ValidationModel;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;

abstract class AbstractApi extends AbstractController
{
    protected $id;

    public function __construct($id = null)
    {
        $this->id = $id;
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

    public function getId(): int
    {
        return $this->id;
    }

    public function glueCategories(array $categories, $delimiter = ','): string
    {
        return implode($delimiter, (array_column($categories, 'name')));
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
}