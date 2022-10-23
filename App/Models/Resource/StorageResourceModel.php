<?php

namespace App\Models\Resource;

use App\Models\Database;

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
}