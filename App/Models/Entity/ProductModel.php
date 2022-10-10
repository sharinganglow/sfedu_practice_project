<?php

namespace App\Models\Entity;

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

    public function getId(): ?string
    {
        return $this->data['id'] ?? null;
    }
}