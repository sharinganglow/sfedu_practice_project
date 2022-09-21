<?php

namespace App\Blocks;

abstract class AbstractBlockHandler
{
    abstract protected function render();

    public function getData(): array
    {
        return $this->data;
    }

    public function setData($data): self
    {
        $this->data = $data;
        return $this;
    }
}