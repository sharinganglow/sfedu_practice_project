<?php

namespace App\Controllers;

use App\Blocks\AddClientBlock;
use App\Models\Database;
use App\Models\Entity\CsrfTokenModel;
use App\Models\Exceptions\LogicalException;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class AddClient extends AbstractController
{
    public function execute(): void
    {
        if ($this->getRequestMethod() == 'GET') {
            $token = new CsrfTokenModel();
            SessionModel::getInstance()->setCsrfToken($token->generateCsrfToken());

            $block = new AddClientBlock();
            $block->render();
        } elseif ($this->isEmailValid()) {

            $newClient = new ClientResourceModel();
            $formAccepted = $this->isInputValid(
                $this->getPostParam('name'),
                $this->getPostParam('surname'),
                $this->getPostParam('email'),
                $this->getPostParam('password'),
                $this->getPostParam('re-password')
            );

            if ($formAccepted) {
                $inputToken = $this->getPostParam('csrf_token');
                $this->verifyToken($inputToken);

                $protectedPass = $newClient->hashPassword($this->getPostParam('password'));
                $newClient->addClient(
                    $this->getPostParam('name'),
                    $this->getPostParam('surname'),
                    $this->getPostParam('email'),
                    $protectedPass
                );
            } else {
                throw new ValidationException('Ошибка при добавлении пользователя');
            }
            $this->redirectTo('mainpage');
        }
    }
}