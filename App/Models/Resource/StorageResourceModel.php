<?php

namespace App\Models\Resource;

use App\Models\Database;
use App\Models\Entity\CategoryModel;
use App\Models\Entity\StorageModel;

class StorageResourceModel extends HandlerResourceModel
{
    protected $table = 'storage';

    public function addStorage($address): void
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'INSERT INTO storage (address) VALUE (?);'
        );
        $query->execute([$address]);
    }

    public function editStorage($address, $id): void
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'UPDATE storage SET address = ? WHERE id = ?;'
        );
        $query->execute([$address, $id]);
    }

    protected function buildItem(array $data): StorageModel
    {
        return $this->buildEmptyItem()->setAddress($data['address'] ?? '');
    }

    protected function buildEmptyItem(): StorageModel
    {
        return new StorageModel();
    }
}