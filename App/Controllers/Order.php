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
            ->setData(2)
            ->render();
    }
}