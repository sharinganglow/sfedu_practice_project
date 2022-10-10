<?php

namespace App\Blocks;

use App\Models\Entity\ClientsModel;
use App\Models\Entity\Model;
use App\Models\Entity\ProductModel;
use App\Models\Entity\ProductsModel;
use App\Models\Exceptions\LogicalException;
use App\Models\Resource\CategoryResourceModel;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class Block
{
    private $path = APP_ROOT . '/views/';

    public function getPath(): ?string
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
        $clientInfo = new ClientsModel();
        $clientInfo->setClient($clientResource->getClientById($clientId));

        return $clientInfo->getData();
    }

    public function getCurrentId(): ?int
    {
        return SessionModel::getInstance()->getClientId();
    }

    public function sanitizeOutput(string $output): string
    {
        return htmlspecialchars($output);
    }

    public function getCsrfToken(): ?string
    {
        return SessionModel::getInstance()->getCsrfToken();
    }

    public function setModel(Model $model): self
    {
        $this->model = $model;
        return $this;
    }

    public function getModel(): ?array
    {
        return $this->model->getData() ?? null;
    }

    public function getProductCategories(int $productId): ?array
    {
        $categoryResource = new CategoryResourceModel();
        return $categoryResource->getAllCategories($productId) ?? null;
    }

    public function getProductCategoriesText($product, $delimiter = ' '): string
    {
        $categories = $this->getProductCategories($product) ?? null;
        return implode($delimiter, (array_column($categories, 'name')));
    }
}