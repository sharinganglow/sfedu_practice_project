<?php

namespace App\Controllers;

use App\Models\Environment\Environment;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

abstract class AbstractController
{
    abstract function execute();

    public function getPostParam($name): string
    {
        return htmlspecialchars($_POST[$name]);
    }

    public function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public function getIdParam(): string
    {
        return $_GET['id'] ?? '';
    }

    public function redirectTo(string $path): void
    {
        $env = Environment::checkInstance();
        header("Location: {$env->getBaseUrl()}{$path}");
        exit();
    }

    public function isEmailValid(): bool
    {
        $email = $this->getPostParam('email');

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
}
