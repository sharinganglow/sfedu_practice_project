<?php

namespace App\Models\Resource;

use App\Models\Database;

class ClientResourceModel extends HandlerResourceModel
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
            throw new \Exception('Пароли не совпадают');
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
            throw new \Exception('Пароли не совпадают');
        }

        return true;
    }
}
