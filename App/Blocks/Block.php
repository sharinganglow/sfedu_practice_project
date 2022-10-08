<?php

namespace App\Blocks;

use App\Models\Entity\Model;
use App\Models\Entity\ProductModel;
use App\Models\Exceptions\LogicalException;
use App\Models\Resource\CategoryResourceModel;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class Block
{
    private $path = APP_ROOT . '/views/';

    public function getPath(): string
    {
        return $this->path;
    }

    public function buildTemplate(): string
    {
        try {
            return "{$this->path}{$this->template}";
        } catch (LogicalException $exception) {
            throw new LogicalException("Не  удалось найти template: $this->template");
        }
    }

    public function getCurrentClient(): array
    {
        $clientResource = new ClientResourceModel();
        $clientId = SessionModel::getInstance()->getClientId();

        return $clientResource->getClientById($clientId);
    }

    public function getCurrentId(): ?int
    {
        return SessionModel::getInstance()->getClientId();
    }

    public function validateOutput(string $output): string
    {
        return htmlspecialchars($output);
    }

    public function getCsrfToken(): ?string
    {
        return SessionModel::getInstance()->getCsrfToken();
    }

    public function setProduct(ProductModel $model): self
    {
        $this->data = $model->getData();
        return $this;
    }

    public function getProduct(): ?array
    {
        return $this->data ?? null;
    }

    public function getProductCategories(int $productId): ?array
    {
        $categoryResource = new CategoryResourceModel();
        return $categoryResource->getAllCategories($productId) ?? null;
    }
}