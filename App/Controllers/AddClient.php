<?php

namespace App\Controllers;

use App\Blocks\AddClientBlock;
use App\Database\Database;

class AddClient extends AbstractController
{
    public function execute(): void
    {
        if (REQUEST_METHOD == 'GET') {
            $block = new AddClientBlock();
            $block->render();
        } else {
            $this->addClient();
        }
    }

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

        header('Location: http://localhost:8001/client');
        return true;
    }
}