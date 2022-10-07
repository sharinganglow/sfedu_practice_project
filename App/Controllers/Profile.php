<?php

namespace App\Controllers;

use App\Blocks\ProfileBlock;
use App\Models\Entity\ClientModel;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class Profile extends AbstractController
{
    public function execute(): void
    {
        $clientResource = new ClientResourceModel();
        $client = new ClientModel();
        $client->setData($clientResource->getQuery());

        $block = new ProfileBlock();
        $block->render();
    }
}