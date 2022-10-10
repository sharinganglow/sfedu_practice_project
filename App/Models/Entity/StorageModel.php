<?php

namespace App\Models\Entity;

class StorageModel extends Model
{
    protected $data = [];

    public function setAddress($data): self
    {
        $this->data['address'] = $data;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->data['address'] ?? null;
    }
}