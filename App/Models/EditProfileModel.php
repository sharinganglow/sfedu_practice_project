<?php

namespace App\Models;

use App\Database\Database;

class EditProfileModel extends HandlerModel
{
    public function updateProfile(): bool
    {
        $name = $this->getPostParam('name');
        $surname = $this->getPostParam('surname');
        $email = $this->getPostParam('email');
        $password = $this->getPostParam('password');
        $rePassword = $this->getPostParam('re-password');
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
            return false;
        }

        header("Location: http://localhost:8003/client?id={$clientId}");
        return true;
    }
}