<?php

namespace App\Controllers;

use App\Blocks\AddClientBlock;
use App\Blocks\ClientBlock;
use App\Blocks\EditProfileBlock;
use App\Models\Database;
use App\Models\Entity\CsrfTokenModel;
use App\Models\Entity\ValidationModel;
use App\Models\Exceptions\LogicalException;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class EditProfile extends AbstractController
{
    public function execute(): void
    {
        $validation = new ValidationModel();

        if ($this->getRequestMethod() == 'GET') {
            $token = new CsrfTokenModel();
            SessionModel::getInstance()->setCsrfToken($token->generateCsrfToken());

            $block = new EditProfileBlock();
            $block->render();
        } elseif ($validation->isEmailValid($this->getPostParam('email'))) {

            $model = new ClientResourceModel();
            $formAccepted = $validation->isInputValid(
                $this->getPostParam('name'),
                $this->getPostParam('surname'),
                $this->getPostParam('email'),
                $this->getPostParam('password'),
                $this->getPostParam('re-password')
            );

            if ($formAccepted) {
                $inputToken = $this->getPostParam('csrf_token');
                $validation->verifyToken($inputToken);

                $protectedPass = $model->hashPassword($this->getPostParam('password'));
                $model->updateProfile(
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