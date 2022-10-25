<?php

namespace App\Models\Entity;

class CountryModel extends Model
{
    protected $data = [];

    public function setCountry($data): self
    {
        $this->data['country'] = $data;
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->data['country'] ?? null;
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