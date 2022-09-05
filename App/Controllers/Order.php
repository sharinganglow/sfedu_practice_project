<?php

namespace App\Controllers;

use App\Blocks\OrderBlock;

class Order
{
    public function execute(): void
    {
        $block = new OrderBlock();
        $block->render();
    }
}