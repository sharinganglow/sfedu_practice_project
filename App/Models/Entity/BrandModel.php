<?php

namespace App\Models\Entity;

class BrandModel extends Model
{
    protected $data = [];

    public function setBrand($data): self
    {
        $this->data['brand'] = $data;
        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->data['brand'] ?? null;
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