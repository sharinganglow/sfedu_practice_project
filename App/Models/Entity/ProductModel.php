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
        $this->data['country'] = $data ?? 'none';
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
}