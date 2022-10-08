<?php

namespace App\Controllers;

use App\Blocks\ClientBlock;
use App\Models\Entity\ClientModel;
use App\Models\Database;
use App\Models\Resource\ClientResourceModel;

class Client
{
    public function execute(): void
    {
        $clientResource = new ClientResourceModel();
        $client = new ClientModel();
        $client->setData($clientResource->getQuery());

        $block = new ClientBlock();
        $block
            ->setClient($client)
            ->render();
    }
}