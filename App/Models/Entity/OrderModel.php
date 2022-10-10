<?php

namespace App\Models\Entity;

class OrderModel extends Model
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

    public function setTotal($data): self
    {
        $this->data['total'] = $data;
        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->data['total'] ?? null;
    }
}