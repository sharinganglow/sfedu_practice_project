<?php

namespace App\Controllers;

use App\Blocks\LoginBlock;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class Login extends AbstractController
{
    public function execute()
    {
        if ($this->getRequestMethod() == 'GET') {
            $block = new LoginBlock();
            $block->render();
        } else {
            $clientResource = new ClientResourceModel();
            $authResult = $this->checkValidate();
            if ($authResult != null) {

                $session = SessionModel::getInstance();
                $session->setClientId($authResult);
                $this->redirectTo('profile');
            }
        }
    }

    public function checkValidate()
    {
        $clientResource = new ClientResourceModel();
        $info = $clientResource->authenticate(
            $this->getPostParam('email'),
            $this->getPostParam('password'));

        if ($info) {
            return $info['id'] ?? null;
        }

        throw new ValidationException('Логин или пароль введены неверно');
    }
}