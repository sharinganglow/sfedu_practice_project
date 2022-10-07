<?php

namespace App\Controllers;

use App\Blocks\ProductBlock;
use App\Models\Database;
use App\Models\Entity\ProductModel;
use App\Models\Resource\ProductResourceModel;

class Product
{
    public function execute(): void
    {
        $productResource = new ProductResourceModel();
        $product = new ProductModel();
        $product->setData($productResource->getQuery());

        $block = new ProductBlock();
        $block->render($product);
    }
}