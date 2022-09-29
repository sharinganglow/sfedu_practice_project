<?php

namespace App\Controllers;

use App\Blocks\ProductUnitBlock;
use App\Models\Database;
use App\Models\ProductModel;
use App\Models\Resource\ProductResourceModel;

class ProductUnit
{
    public function execute(): void
    {
        $productUnitResource = new ProductResourceModel();
        $product = new ProductModel();
        $product->setData($productUnitResource->getProductById($_GET['id']));

        $block = new ProductUnitBlock();
        $block->render($product);
    }
}