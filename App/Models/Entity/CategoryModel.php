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
}