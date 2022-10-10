<?php

namespace App\Models\Entity;

class StoragesModel extends Model
{
    public function setStorage($data): self
    {
        $storage = new StorageModel();
        $storage->setAddress($data['address']);

        $this->data [] = $storage;
        return $this;
    }
}