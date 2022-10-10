<?php

namespace App\Models\Entity;

class ClientModel extends Model
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

    public function setSurname($data): self
    {
        $this->data['surname'] = $data;
        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->data['surname'] ?? null;
    }

    public function setEmail($data): self
    {
        $this->data['email'] = $data;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->data['email'] ?? null;
    }

    public function setPassword($data): self
    {
        $this->data['password'] = $data;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->data['password'] ?? null;
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