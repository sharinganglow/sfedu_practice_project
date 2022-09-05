<?php

namespace App\Controllers;

use App\Blocks\ClientBlock;

class Client
{
    public function execute(): void
    {
        $block = new ClientBlock();
        $block->render();
    }
}