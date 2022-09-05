<?php

namespace App\Controllers;

use App\Blocks\ProductBlock;

class Product
{
    public function execute(): void
    {
        $block = new ProductBlock();
        $block->render();
    }
}