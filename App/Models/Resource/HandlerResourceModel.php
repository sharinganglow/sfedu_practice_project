<?php

namespace App\Models\Resource;

use App\Models\Database;

abstract class HandlerResourceModel
{
    public function getQuery(): array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT * FROM {$this->table}");
        $query->execute();

        return $query->fetchAll();
    }

    public function getColumn($columnName): array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT {$columnName} FROM {$this->table}");
        $query->execute();

        return $query->fetchAll();
    }
}