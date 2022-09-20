<?php

namespace App\Controllers;

use App\Blocks\OrderBlock;
use App\Database\Database;

class Order
{
    public function execute(): void
    {
        $block = new OrderBlock();
        $block
            ->initOrder(2)
            ->render();
    }
}