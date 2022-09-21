<?php

namespace App\Controllers;

use App\Blocks\ProductUnitBlock;
use App\Database\Database;
use App\Models\ProductUnitModel;

class ProductUnit
{
    public function execute(): void
    {
        $productUnit = new ProductUnitModel();

        $block = new ProductUnitBlock();
        $block
            ->setData($productUnit->getQuery())
            ->render();
    }
}