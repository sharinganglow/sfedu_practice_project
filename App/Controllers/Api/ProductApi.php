<?php

namespace App\Controllers\Api;

use App\Controllers\AbstractController;
use App\Models\Entity\ProductModel;
use App\Models\Exceptions\LogicalException;
use App\Models\Resource\BrandResourceModel;
use App\Models\Resource\CategoryResourceModel;
use App\Models\Resource\CountryResourceModel;
use App\Models\Resource\ProductResourceModel;

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
        $productResource = new ProductResourceModel();
        $category = new CategoryResourceModel();
        $data = $productResource->getProductById($this->getId());

        $categoryList = $this->glueCategories($category->getAllCategories($this->getId()));
        $product = [
            'name'      => $data->getName(),
            'price'     => $data->getPrice(),
            'country'   => $data->getCountry(),
            'brand'     => $data->getBrand(),
            'date'      => $data->getDate(),
            'category'  => $categoryList
        ];

        $this->display($product);
    }

    public function getProductsList()
    {
        $productResource = new ProductResourceModel();
        $data = $productResource->getQuery();
        $category = new CategoryResourceModel();


        $productList = [];
        foreach ($data as $row) {
            $categoryList = $this->glueCategories($category->getAllCategories($row->getId()));

            $unit = [
                'name' => $row->getName(),
                'price' => $row->getPrice(),
                'country' => $row->getCountry(),
                'brand' => $row->getBrand(),
                'date' => $row->getDate(),
                'category' => $categoryList
            ];
            $productList [] = $unit;
        }
        $this->display($productList);
    }

    public function editProduct()
    {
        $product = new ProductModel();
        $product->executeProductEdition($this->decodeJsonRequest(), $this->getId());
    }

    public function addProduct(): void
    {
        $product = new ProductModel();
        $product->executeProductAddition($this->decodeJsonRequest());
    }

    public function deleteProduct(): void
    {
        try {
            $productResource = new ProductResourceModel();
            $productResource->deleteEntity($this->getId());
        } catch (LogicalException $exception) {
            throw new LogicalException('Ошибка при удалении сущности' . PHP_EOL);
        }
    }
}