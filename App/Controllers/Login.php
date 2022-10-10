<?php

namespace App\Controllers;

use App\Blocks\LoginBlock;
use App\Models\Service\CsrfTokenModel;
use App\Models\Entity\ValidationModel;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class Login extends AbstractController
{
    public function execute(): void
    {
        $validation = new ValidationModel();

        if ($this->getRequestMethod() == 'GET') {
            $token = new CsrfTokenModel();
            SessionModel::getInstance()->setCsrfToken($token->generateCsrfToken());

            $block = new LoginBlock();
            $block->render();
        } else {

            $authResult = $validation->checkValidation(
                $this->getPostParam('email'),
                $this->getPostParam('password')
            );
            if ($authResult != null) {
                $validation->verifyToken();
                SessionModel::getInstance()->setClientId($authResult);

                $this->redirectTo('profile');
            }
        }
    }
}