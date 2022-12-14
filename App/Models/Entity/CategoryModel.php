<?php

namespace App\Models\Entity;

class CategoryModel extends Model
{
    protected $data = [];

    public function setCategory($data): self
    {
        $this->data['category'] = $data;
        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->data['category'] ?? null;
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