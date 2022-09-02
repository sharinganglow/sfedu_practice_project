<?php

namespace App\Controllers;

use App\Blocks\ClientBlock;

class Client
{
    public function greetUser() :void
    {
        $block = new ClientBlock();
        $block->render();
    }
}