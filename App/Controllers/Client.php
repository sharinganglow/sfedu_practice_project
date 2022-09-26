<?php

namespace App\Controllers;

use App\Blocks\ClientBlock;
use App\Models\ClientModel;
use App\Models\ClientsModel;
use App\Models\Database;
use App\Models\Resource\ClientResourceModel;

class Client
{
    public function execute(): void
    {
        $clientResource = new ClientResourceModel();
        $clientsList = new ClientsModel();
        foreach ($clientResource->getQuery() as $item) {
            $client = new ClientModel();
            $client->setId($item['id']);
            $client->setName($item['name']);
            $client->setSurname($item['surname']);
            $client->setEmail($item['email']);
            $client->setPassword($item['password']);
            $clientsList->addClient($client);
        }

        $block = new ClientBlock();
        $block->render($clientsList);
    }
}