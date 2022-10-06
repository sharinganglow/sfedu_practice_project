<?php

namespace App\Controllers;

use App\Blocks\AddClientBlock;
use App\Blocks\ClientBlock;
use App\Blocks\EditProfileBlock;
use App\Models\Database;
use App\Models\ProjectException\ProjectException;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class EditProfile extends AbstractController
{
    public function execute(): void
    {
        if ($this->getRequestMethod() == 'GET') {
            $block = new EditProfileBlock();
            $block->render();
        } elseif ($this->checkEmail()) {
            $model = new ClientResourceModel();
            $model->updateProfile(
                $this->getPostParam('name'),
                $this->getPostParam('surname'),
                $this->getPostParam('email'),
                $this->getPostParam('password'),
                $this->getPostParam('re-password'),
            );

            $this->redirectTo();
        }
    }

    public function checkEmail(): bool
    {
        $email = $this->getPostParam('email');

        if (!$email) {
            throw new ProjectException('Поле с почтой не заполнено');
        }

        $session = SessionModel::getInstance();
        $clientResource = new ClientResourceModel();
        $clientInfo = $clientResource->checkExistingEmail($email);
        if ($clientInfo && $clientInfo['id'] != $session->getClientId()) {
            throw new ProjectException('Данная почта уже используется');
        }

        return true;
    }
}