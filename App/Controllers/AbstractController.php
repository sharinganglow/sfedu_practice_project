<?php

namespace App\Controllers;

use App\Blocks\AddClientBlock;
use App\Blocks\EditProfileBlock;
use App\Models\Entity\ValidationModel;
use App\Models\Environment\Environment;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;
use App\Models\Service\CsrfTokenModel;
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

    public function executeGetForm(string $type): void
    {
        $token = new CsrfTokenModel();
        SessionModel::getInstance()->setCsrfToken($token->generateCsrfToken());

        if ($type == 'edit') {
            $block = new EditProfileBlock();
        } else {
            $block = new AddClientBlock();
        }

        $block->render();
    }

    public function executePostForm(string $type): void
    {
        $validation = new ValidationModel();
        $model = new ClientResourceModel();
        $isFormAccepted = $validation->isInputValid();

        if (!$isFormAccepted) {
            throw new ValidationException('Ошибка при добавлении пользователя');
        }
        $validation->verifyToken();
        $protectedPass = $model->hashPassword($this->getPostParam('password'));

        if ($type == 'edit') {
            $model->updateProfile(
                $this->getPostParam('name'),
                $this->getPostParam('surname'),
                $this->getPostParam('email'),
                $protectedPass
            );
        } else {
            $model->addClient(
                $this->getPostParam('name'),
                $this->getPostParam('surname'),
                $this->getPostParam('email'),
                $protectedPass
            );
        }
    }
}
