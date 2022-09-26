<?php

namespace App\Controllers;

use App\Blocks\AddClientBlock;
use App\Models\Database;
use App\Models\Resource\ClientResourceModel;

class AddClient extends AbstractController
{
    public function execute(): void
    {
        if ($this->getRequestMethod() == 'GET') {
            $block = new AddClientBlock();
            $block->render();
        } else {
            $newClient = new ClientResourceModel();
            $newClient->addClient(
                $this->getPostParam('name'),
                $this->getPostParam('surname'),
                $this->getPostParam('email'),
                $this->getPostParam('password'),
                $this->getPostParam('re-password'),
            );
            header('Location: http://localhost:8001/client');
            exit();
        }
    }
}