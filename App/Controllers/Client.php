<?php

namespace App\Controllers;

use App\Blocks\ClientBlock;
use App\Models\Entity\ClientModel;
use App\Models\Database;
use App\Models\Entity\ClientsModel;
use App\Models\Resource\ClientResourceModel;

class Client
{
    public function execute(): void
    {
        $clientResource = new ClientResourceModel();
        $client = new ClientModel();
        $clientsList = new ClientsModel();

        foreach ($clientResource->getQuery() as $item) {
            $clientsList->setClient($item);
        }

        $block = new ClientBlock();
        $block
            ->setModel($clientsList)
            ->render();
    }
}