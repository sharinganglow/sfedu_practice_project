<?php

namespace App\Controllers\Api;

use App\Controllers\AbstractController;
use App\Models\Entity\ProductsModel;
use App\Models\Exceptions\LogicalException;
use App\Models\Resource\BrandResourceModel;
use App\Models\Resource\CategoryResourceModel;
use App\Models\Resource\CountryResourceModel;
use App\Models\Resource\ProductResourceModel;

class ProductApi extends AbstractApi
{
    public function execute()
    {
        if ($this->getRequestMethod() == 'GET') {
            if ($this->hasId()) {
                $this->getProduct();
            } else {
                $this->getProductsList();
            }
        }

        if ($this->getRequestMethod() == 'PUT') {
            $this->editProduct();
            header('Status: 200');
        }

        if ($this->getRequestMethod() == 'POST') {
            $this->addProduct();
            header('Status: 200');
        }

        if ($this->getRequestMethod() == 'DELETE') {
            $this->deleteProduct();
            header('Status: 200');
        }
    }

    public function getProduct()
    {
        $productResource = new ProductResourceModel();
        $category = new CategoryResourceModel();
        $product = new ProductsModel();
        $product->setProduct($productResource->getProductById($this->getId()));
        $data = $product->getData()[0];

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
        $category = new CategoryResourceModel();

        $productList = [];
        foreach ($productResource->getQuery() as $row) {
            $categoryList = $this->glueCategories($category->getAllCategories($row['id_product']));
            $product = new ProductsModel();
            $product->setProduct($row);
            $data = $product->getData()[0];

            $unit = [
                'name' => $data->getName(),
                'price' => $data->getPrice(),
                'country' => $data->getCountry(),
                'brand' => $data->getBrand(),
                'date' => $data->getDate(),
                'category' => $categoryList
            ];
            $productList [] = $unit;
        }
        $this->display($productList);
    }

    public function editProduct()
    {
        $this->executeProductEdition($this->decodeJson(), $this->getId());
    }

    public function addProduct(): void
    {
        $this->executeProductAddition($this->decodeJson());
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