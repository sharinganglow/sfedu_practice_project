<?php

namespace App\Controllers;

use App\Blocks\ProductBlock;

class Product
{
    public function greetUser() :void
    {
        $block = new ProductBlock();
        $block->render();
    }
}