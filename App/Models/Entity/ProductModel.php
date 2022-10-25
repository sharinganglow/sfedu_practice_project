<?php

namespace App\Models\Entity;

use App\Models\Resource\BrandResourceModel;
use App\Models\Resource\CategoryResourceModel;
use App\Models\Resource\CountryResourceModel;
use App\Models\Resource\ProductResourceModel;

class ProductModel extends Model
{
    protected $data = [];

    public function setName($data): self
    {
        $this->data['name'] = $data;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }

    public function setPrice($data): self
    {
        $this->data['price'] = $data;
        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->data['price'] ?? null;
    }

    public function setCountry($data): self
    {
        $this->data['country'] = $data;
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->data['country'] ?? null;
    }

    public function setBrand($data): self
    {
        $this->data['brand'] = $data;
        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->data['brand'] ?? null;
    }

    public function setDate($data): self
    {
        $this->data['date'] = $data;
        return $this;
    }

    public function getDate(): ?string
    {
        return $this->data['date'] ?? null;
    }

    public function setId($data): self
    {
        $this->data['id'] = $data;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->data['id'] ?? null;
    }

    public function getAll(): array
    {
        $productResource = new ProductResourceModel();
        return $productResource->getQuery();
    }

    public function executeProductAddition(array $data): void
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

    public function executeProductEdition(array $data, $id): void
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