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

        $block = new ProductUnitBlock();
        $block
            ->setProduct($productUnitResource->getProductById($this->getIdParam()))
            ->render();
    }
}