<?php

namespace App\Models;

class Model
{
    protected $data = [];

    public function setData($data): self
    {
        $this->data = $data ?? 0;
        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }
}