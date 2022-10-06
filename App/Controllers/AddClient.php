<?php

namespace App\Controllers;

use App\Blocks\AddClientBlock;
use App\Models\Database;
use App\Models\ProjectException\ProjectException;
use App\Models\Resource\ClientResourceModel;

class AddClient extends AbstractController
{
    public function execute(): void
    {
        if ($this->getRequestMethod() == 'GET') {
            $block = new AddClientBlock();
            $block->render();
        } elseif ($this->checkEmail()) {
            $newClient = new ClientResourceModel();
            $newClient->addClient(
                $this->getPostParam('name'),
                $this->getPostParam('surname'),
                $this->getPostParam('email'),
                $this->getPostParam('password'),
                $this->getPostParam('re-password'),
            );

            $this->redirectTo('profile');
        }
    }

    public function checkEmail(): bool
    {
        $email = $this->getPostParam('email');

        if (!$email) {
            throw new ProjectException('Поле с почтой не заполнено');
        }

        $clientResource = new ClientResourceModel();
        if ($clientResource->checkExistingEmail($email)) {
            throw new ProjectException('Данная почта уже используется');
        }

        return true;
    }
}