<?php

namespace App\Controllers;

use App\Blocks\ProductBlock;
use App\Models\Database;
use App\Models\Resource\ProductResourceModel;

class Product
{
    public function execute(): void
    {
        $product = new ProductResourceModel();

        $block = new ProductBlock();
        $block
            ->setData($product->getQuery())
            ->render();
    }
}