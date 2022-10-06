<?php

namespace App\Controllers;

use App\Blocks\ProfileBlock;
use App\Models\ClientModel;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class Profile extends AbstractController
{
    public function execute()
    {
        $clientResource = new ClientResourceModel();
        $client = new ClientModel();
        $client->setData($clientResource->getQuery());

        $block = new ProfileBlock();
        $block->render();
    }
}