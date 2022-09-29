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

    public function deleteRecord(string $table, $product_id, string $row = 'product_id'): void
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            "DELETE FROM {$table} WHERE {$row} = ?;"
        );
        $query->bindParam(1, $product_id, \PDO::PARAM_INT | \PDO::PARAM_INPUT_OUTPUT);
        $heh = $query->execute();
    }
}