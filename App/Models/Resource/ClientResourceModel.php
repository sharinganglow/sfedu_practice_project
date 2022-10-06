<?php

namespace App\Models\Resource;

use App\Models\Database;
use App\Models\ProjectException\ProjectException;

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

    public function addClient($name, $surname, $email, $password, $rePassword): bool
    {
        $hasRequiredFields = $name && $surname && $email && $password;
        $hasPasswordMatch  = $password === $rePassword;
        if ($hasRequiredFields && $hasPasswordMatch) {
            $connection = Database::getConnection();
            $query = $connection->prepare(
                'INSERT INTO client (name, surname, email, password) VALUES (?, ?, ?, ?);'
            );
            $query->execute([$name, $surname, $email, $password]);
        } else {
            throw new ProjectException('Пароли не совпадают');
        }

        return true;
    }

    public function updateProfile($name, $surname, $email, $password, $rePassword): bool
    {
        $clientId = $_GET['id'];

        $hasRequiredFields = $name && $surname && $email && $password;
        $hasPasswordMatch  = $password === $rePassword;
        if ($hasRequiredFields && $hasPasswordMatch) {
            $connection = Database::getConnection();
            $query = $connection->prepare(
                'UPDATE client SET name = ?, 
                        surname = ?, email = ?, password = ? 
                        WHERE id = ?;'
            );
            $query->execute([$name, $surname, $email, $password, $clientId]);
        } else {
            throw new ProjectException('Пароли не совпадают');
        }

        return true;
    }

    public function checkExistingEmail(string $email): ?array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare('SELECT email, id FROM client WHERE email = ?;');
        $query->execute([$email]);

        return $query->fetch();
    }


    public function authenticate(string $email, string $password): ?int
    {
        $connection = Database::getConnection();
        $query = $connection->prepare('SELECT email, password, id FROM client WHERE email = ?;');
        $query->bindParam(1, $email, \PDO::PARAM_INT | \PDO::PARAM_INPUT_OUTPUT);
        $query->execute();

        $info = $query->fetch();
        if ($info['email'] == $email || $info['password'] == $password) {
            return $info['id'] ?? null;
        }

        throw new ProjectException('Логин или пароль введены неверно');
    }
}
