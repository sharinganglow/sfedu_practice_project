<?php

namespace App\Models\Resource;

use App\Models\Database;
use App\Models\Exceptions\LogicalException;
use App\Models\Exceptions\ValidationException;

class ClientResourceModel extends HandlerResourceModel
{
    protected $table = 'client';

    public function getClientById($id): array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare('SELECT * FROM client WHERE id = ?;');

        $query->bindParam(1, $id, \PDO::PARAM_INT | \PDO::PARAM_INPUT_OUTPUT);
        $query->execute();

        return $query->fetch();
    }

    public function getClientId($email, $password)
    {
        $connection = Database::getConnection();
        $query = $connection->prepare('SELECT id FROM client WHERE email = ? AND password = ?;');

        $query->bindParam(2, $email, $password, \PDO::PARAM_INT | \PDO::PARAM_INPUT_OUTPUT);
        $query->execute();

        return $query->fetch();
    }

    public function addClient($name, $surname, $email, $password): void
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'INSERT INTO client (name, surname, email, password) VALUES (?, ?, ?, ?);'
        );
        $query->execute([$name, $surname, $email, $password]);
    }

    public function editProfile($name, $surname, $email, $password, $clientId = null): void
    {
        if (!isset($clientId)) {
            $clientId = $_GET['id'];
        }

        $connection = Database::getConnection();
        $query = $connection->prepare(
            'UPDATE client SET name = ?, 
                    surname = ?, email = ?, password = ? 
                    WHERE id = ?;'
        );
        $query->execute([$name, $surname, $email, $password, $clientId]);
    }

    public function updateProfile($name, $surname, $id): void
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'UPDATE client SET name = ?, surname = ? WHERE id = ?;'
        );
        $query->execute([$name, $surname, $id]);
    }

    public function checkExistingEmail(string $email): ?array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare('SELECT email, id FROM client WHERE email = ?;');
        $query->execute([$email]);

        return $query->fetchAll();
    }


    public function getByEmail(string $email): ?array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare('SELECT email, password, id FROM client WHERE email = ?;');
        $query->bindParam(1, $email, \PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT);
        $query->execute();

        return $query->fetch() ?? null;
    }
}
