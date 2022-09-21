<?php

namespace App\Models;

use App\Database\Database;

class ClientModel extends HandlerModel
{
    protected $table = 'client';

    public function getClientById(): array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare('SELECT * FROM client WHERE id = ?;');

        $query->bindParam(1, $_GET['id'], \PDO::PARAM_INT | \PDO::PARAM_INPUT_OUTPUT);
        $query->execute();

        return $query->fetch();
    }
}
