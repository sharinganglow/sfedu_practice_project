<?php

namespace App\Models\Resource;

use App\Models\Database;
use App\Models\Entity\Model;

abstract class HandlerResourceModel
{
    public function getQuery(): array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT * FROM {$this->table}");
        $query->execute();
        $data = $query->fetchAll();

        $result = [];
        foreach ($data as $datum) {
            $result [] = $this->buildItem($datum);
        }

        return $result;
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
        $query->execute([$entityId]);
    }

    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    protected function getRowByColumn($column, $value): Model
    {
        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT * FROM {$this->table} WHERE {$column} = :value;");
        $query->bindParam(':value', $value, \PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT);
        $query->execute();
        $data = $query->fetch();

        return $data ? $this->buildItem($data) : $this->buildEmptyItem();
    }

    public function getRecordById($id): Model
    {
        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT * FROM {$this->table} WHERE id = ?;");

        $query->execute([$id]);
        $data = $query->fetch();

        return $data ? $this->buildItem($data) : $this->buildEmptyItem();
    }
}