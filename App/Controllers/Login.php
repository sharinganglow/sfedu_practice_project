<?php

namespace App\Controllers;

use App\Blocks\LoginBlock;
use App\Models\Entity\CsrfTokenModel;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class Login extends AbstractController
{
    public function execute(): void
    {
        if ($this->getRequestMethod() == 'GET') {
            $token = new CsrfTokenModel();
            SessionModel::getInstance()->setCsrfToken($token->generateCsrfToken());

            $block = new LoginBlock();
            $block->render();
        } else {
            $clientResource = new ClientResourceModel();
            $authResult = $this->checkValidate();

            if ($authResult != null) {
                $inputToken = $this->getPostParam('csrf_token');
                $this->verifyToken($inputToken);
                SessionModel::getInstance()->setClientId($authResult);

                $this->redirectTo('profile');
            }
        }
    }

    public function checkValidate(): ?int
    {
        $clientResource = new ClientResourceModel();
        $info = $clientResource->authenticate($this->getPostParam('email'));

        if ($info && $this->verifyPassword($this->getPostParam('password'), $info['password'])) {
            return $info['id'] ?? null;
        }

        throw new ValidationException('Логин или пароль введены неверно');
    }

    public function verifyPassword($password, $hash): bool
    {
        return password_verify($password, $hash);
    }
}