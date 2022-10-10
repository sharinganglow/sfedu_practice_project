<?php

namespace App\Controllers;

use App\Blocks\ProductUnitBlock;
use App\Models\Database;
use App\Models\Entity\ProductModel;
use App\Models\Entity\ProductsModel;
use App\Models\Resource\ProductResourceModel;

class ProductUnit extends AbstractController
{
    public function execute(): void
    {
        $productUnitResource = new ProductResourceModel();
        $product = new ProductModel();

        $productsList = new ProductsModel();
        $productsList->setProduct($productUnitResource->getProductById($this->getIdParam()));

        $block = new ProductUnitBlock();
        $block
            ->setModel($productsList)
            ->render();
    }
}