<?php

namespace App\Controllers;

use App\Blocks\AddClientBlock;
use App\Database\Database;

class AddClient
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

    public function addClient()
    {
        $name = htmlspecialchars($_POST['name']);
        $surname = htmlspecialchars($_POST['surname']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $rePassword = htmlspecialchars($_POST['re-password']);

        if ($password == $rePassword) {
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