<?php

namespace App\Controllers;

use App\Blocks\ProductUnitBlock;
use App\Models\Database;
use App\Models\Resource\ProductResourceModel;

class ProductUnit
{
    public function execute(): void
    {
        $productUnit = new ProductResourceModel();

        $block = new ProductUnitBlock();
        $block
            ->setData($productUnit->getProductById($_GET['id']))
            ->render();
    }
}