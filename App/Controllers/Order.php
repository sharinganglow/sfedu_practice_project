<?php

namespace App\Controllers;

use App\Blocks\OrderBlock;

class Order
{
    public function greetUser() :void
    {
        $block = new OrderBlock();
        $block->render();
    }
}