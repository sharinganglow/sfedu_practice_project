<?php

namespace App\Models;

use App\Database\Database;

class AddClientModel extends HandlerModel
{
    public function addClient(): bool
    {
        $name = $this->getPostParam('name');
        $surname = $this->getPostParam('surname');
        $email = $this->getPostParam('email');
        $password = $this->getPostParam('password');
        $rePassword = $this->getPostParam('re-password');

        $hasRequiredFields = $name && $surname && $email && $password;
        $hasPasswordMatch  = $password === $rePassword;
        if ($hasRequiredFields && $hasPasswordMatch) {
            $connection = Database::getConnection();
            $query = $connection->prepare(
                'INSERT INTO client (name, surname, email, password) VALUES (?, ?, ?, ?);'
            );
            $query->execute([$name, $surname, $email, $password]);
        } else {
            return false;
        }

        header("Location: http://localhost:8003/client");
        return true;
    }
}