<?php

namespace App\Controllers;

use App\Blocks\AddClientBlock;
use App\Database\Database;
use App\Models\AddClientModel;

class AddClient extends AbstractController
{
    public function execute(): void
    {
        if (REQUEST_METHOD == 'GET') {
            $block = new AddClientBlock();
            $block->render();
        } else {
            $newClient = new AddClientModel();
            $newClient->addClient();
        }
    }
}