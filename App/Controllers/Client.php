<?php

namespace App\Controllers;

use App\Blocks\ClientBlock;
use App\Database\Database;
use App\Models\ClientModel;

class Client
{
    public function execute(): void
    {
        $client = new ClientModel();

        $block = new ClientBlock();
        $block
            ->setData($client->getQuery())
            ->render();
    }
}