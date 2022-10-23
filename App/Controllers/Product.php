<?php

namespace App\Controllers;

use App\Blocks\ProductBlock;
use App\Models\Database;
use App\Models\Entity\ProductModel;
use App\Models\Entity\ProductsModel;
use App\Models\Resource\ProductResourceModel;

class Product
{
    public function execute(): void
    {
        $productResource = new ProductResourceModel();
        $productsList = new ProductsModel();

        foreach ($productResource->getQuery() as $item) {
            $productsList->setProduct($item);
        }

        $block = new ProductBlock();
        $block
            ->setModel($productsList)
            ->render();
    }
}