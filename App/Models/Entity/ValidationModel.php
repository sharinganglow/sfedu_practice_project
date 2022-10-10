<?php

namespace App\Models\Entity;

use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class ValidationModel
{
    public function isEmailValid($email): bool
    {
        if (!$email) {
            throw new ValidationException('Поле с почтой не заполнено');
        }

        $session = SessionModel::getInstance();
        $clientResource = new ClientResourceModel();
        $clientInfo = $clientResource->checkExistingEmail($email);
        if ($clientInfo && $clientInfo[0]['id'] != $session->getClientId()) {
            throw new ValidationException('Данная почта уже используется');
        }

        return true;
    }

    public function isInputValid($input): bool
    {
        $hasRequiredFields = $input['name'] && $input['surname'] && $input['email'] && $input['password'];
        $hasPasswordMatch  = $input['password'] === $input['re-password'];
        if (!$hasPasswordMatch) {
            throw new ValidationException('Пароли не совпадают');
        }

        if (!$hasRequiredFields) {
            throw new ValidationException('Пожалуйста, заполните обязательные поля');
        }

         return true;
    }

    public function verifyToken($postToken): void
    {
        $sessionToken = SessionModel::getInstance()->getCsrfToken();

        if ($sessionToken !== $postToken) {
            throw new ValidationException('Не пакостить на этом сайте');
        }
    }

    public function checkValidation(string $email, string $password): ?int
    {
        $clientResource = new ClientResourceModel();
        $info = $clientResource->getByEmail($email);

        if ($info && $this->verifyPassword($password, $info['password'])) {
            return $info['id'] ?? null;
        }

        throw new ValidationException('Логин или пароль введены неверно');
    }

    public function verifyPassword($password, $hash): bool
    {
        return password_verify($password, $hash);
    }
}