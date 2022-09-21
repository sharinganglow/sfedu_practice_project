<?php

namespace App\Controllers;

use App\Blocks\ProductBlock;
use App\Database\Database;
use App\Models\ProductModel;

class Product
{
    public function execute(): void
    {
        $product = new ProductModel();

        $block = new ProductBlock();
        $block
            ->setData($product->getQuery())
            ->render();
    }
}