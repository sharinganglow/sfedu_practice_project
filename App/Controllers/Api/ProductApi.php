<?php

namespace App\Controllers\Api;

use App\Models\Cache\FileCache;
use App\Models\Exceptions\LogicalException;
use App\Models\Resource\ProductResourceModel;
use App\Models\Service\ProductService;

class ProductApi extends AbstractApi
{
    public function execute()
    {
        if ($this->isGet()) {
            if ($this->hasId()) {
                $this->getProduct();
            } else {
                $this->getProductsList();
            }
            $this->success();
        }

        if ($this->isPut()) {
            $this->editProduct();
            $this->success();
        }

        if ($this->isPost()) {
            $this->addProduct();
            $this->success();
        }

        if ($this->isDelete()) {
            $this->deleteProduct();
            $this->success();
        }

        $this->noRoute();
    }

    public function getProduct()
    {
        $service = new ProductService();
        $this->display($this->getData('cached_product', $service));
    }

    public function getProductsList()
    {
        $service = new ProductService();
        $this->display($this->getData('cached_products_list', $service));
    }

    public function editProduct()
    {
        $product = new ProductService();
        $cache = new FileCache();
        $product->edit($this->decodeJsonRequest(), $this->getId());

        $data = $product->getAll();
        $cache->set('cached_products_list', $data);
        $data = $product->getUnit($this->getId());
        $cache->set('cached_product', $data, $this->getId());
    }

    public function addProduct(): void
    {
        $product = new ProductService();
        $cache = new FileCache();
        $product->add($this->decodeJsonRequest());

        $data = $product->getAll();
        $cache->set('cached_products_list', $data);
    }

    public function deleteProduct(): void
    {
        try {
            $productResource = new ProductResourceModel();
            $service = new ProductService();
            $cache = new FileCache();
            $productResource->deleteEntity($this->getId());

            $data = $service->getAll();
            $cache->set('cached_products_list', $data);
            $cache->delete('cached_product', $this->getId());

        } catch (LogicalException $exception) {
            throw new LogicalException('Ошибка при удалении сущности' . PHP_EOL);
        }
    }
}