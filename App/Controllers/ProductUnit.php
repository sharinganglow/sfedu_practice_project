<?php

namespace App\Controllers;

use App\Blocks\ProductUnitBlock;
use App\Models\Database;
use App\Models\Entity\ProductModel;
use App\Models\Resource\ProductResourceModel;

class ProductUnit extends AbstractController
{
    public function execute(): void
    {
        $productUnitResource = new ProductResourceModel();
        $product = new ProductModel();
        $product->setData($productUnitResource->getProductById($this->getIDParam()));

        $block = new ProductUnitBlock();
        $block->render($product);
    }
}