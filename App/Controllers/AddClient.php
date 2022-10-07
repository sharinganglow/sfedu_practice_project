<?php

namespace App\Controllers;

use App\Blocks\AddClientBlock;
use App\Models\Database;
use App\Models\Exceptions\LogicalException;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class AddClient extends AbstractController
{
    public function execute(): void
    {
        if ($this->getRequestMethod() == 'GET') {
            $block = new AddClientBlock();
            $block->render();
        } elseif ($this->isEmailValid()) {
            $newClient = new ClientResourceModel();
            $newClient->addClient(
                $this->getPostParam('name'),
                $this->getPostParam('surname'),
                $this->getPostParam('email'),
                $this->getPostParam('password'),
                $this->getPostParam('re-password'),
            );

            $this->redirectTo('mainpage');
        }
    }
}