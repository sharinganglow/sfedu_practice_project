<?php

namespace App\Models\Service;

use App\Models\Resource\BrandResourceModel;
use App\Models\Resource\CategoryResourceModel;
use App\Models\Resource\CountryResourceModel;
use App\Models\Resource\ProductResourceModel;

class ProductService extends AbstractService
{
    public function getUnit(int $id): array
    {
        $productResource = new ProductResourceModel();
        $category = new CategoryResourceModel();
        $service = new CategoryService();
        $data = $productResource->getProductById($id);

        $categoryList = $service->glue($category->getAllCategories($id));
        $product = [
            'name'      => $data->getName(),
            'price'     => $data->getPrice(),
            'country'   => $data->getCountry(),
            'brand'     => $data->getBrand(),
            'date'      => $data->getDate(),
            'category'  => $categoryList
        ];

        return $product;
    }

    public function getAll(): array
    {
        $productResource = new ProductResourceModel();
        $data = $productResource->getQuery();
        $service = new CategoryService();
        $category = new CategoryResourceModel();

        $productList = [];
        foreach ($data as $row) {
            $categoryList = $service->glue($category->getAllCategories($row->getId()));

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

        return $productList;
    }

    public function add(array $data): void
    {
        $brandResource = new BrandResourceModel();
        $countryResource = new CountryResourceModel();
        $categoryResource = new CategoryResourceModel();
        $productResource = new ProductResourceModel();

        $brandResource->addBrand($data['brand']);
        $countryResource->addCountry($data['country']);

        $country = $countryResource->getByCountry($data['country']);
        $brand = $brandResource->getByBrand($data['brand']);

        $inputData = [
            'name'      => $data['name'],
            'price'     => $data['price'],
            'country'   => $country->getId(),
            'brand'     => $brand->getId(),
            'date'      => $data['date'],
        ];
        $productResource->addProduct($inputData);
        $productId = $productResource->getProductId('name', $data['name']);

        $categories = explode(', ', $data['category']);
        foreach ($categories as $item) {
            $categoryResource->addCategory($item, $data['date']);
            $category = $categoryResource->getByName($item);
            $categoryResource->tieWithProduct($productId, $category->getId());
        }
    }

    public function edit(array $data, $id): void
    {
        $brandResource = new BrandResourceModel();
        $countryResource = new CountryResourceModel();
        $categoryResource = new CategoryResourceModel();
        $productResource = new ProductResourceModel();

        if (!$brandResource->isExist($data['brand'])) {
            $brandResource->addBrand($data['brand']);
        }
        $brand = $brandResource->getByBrand($data['brand']);

        if (!$countryResource->isExist($data['country'])) {
            $countryResource->addCountry($data['country']);
        }
        $country = $countryResource->getByCountry($data['country']);

        $inputData = [
            'name'      => $data['name'],
            'price'     => $data['price'],
            'country'   => $country->getId(),
            'brand'     => $brand->getId(),
            'date'      => $data['date'],
            'id'        => $id
        ];
        $productResource->editProduct($inputData);
        $productId = $productResource->getProductId('name', $data['name']);

        $categories = explode(', ', $data['category']);
        $categoryResource->clearCategories($productId);
        foreach ($categories as $item) {
            if (!$categoryResource->isExist($item)) {
                $categoryResource->addCategory($item, $data['date']);
            }
            $category = $categoryResource->getByName($item);
            $categoryResource->tieWithProduct($productId, $category->getId());
        }
    }
}
