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

    public function deleteEntity($entityId): void
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            "DELETE FROM {$this->table} WHERE id = ?;"
        );
        $query->bindParam(1, $entityId, \PDO::PARAM_INT | \PDO::PARAM_INPUT_OUTPUT);
        $query->execute();
    }

    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}