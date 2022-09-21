<?php

namespace App\Models;

use App\Database\Database;

abstract class HandlerModel
{
    public function getPostParam($param): string
    {
        return htmlspecialchars($_POST[$param]);
    }

    public function getQuery(): array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT * FROM {$this->table}");
        $query->execute();

        return $query->fetchAll();
    }
}