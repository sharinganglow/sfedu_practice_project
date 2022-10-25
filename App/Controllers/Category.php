<?php

namespace App\Controllers;

use App\Blocks\CategoryBlock;
use App\Models\Entity\CategoryModel;
use App\Models\Database;
use App\Models\Resource\CategoryResourceModel;

class Category
{
    public function execute(): void
    {
        $categoryResource = new CategoryResourceModel();

        $block = new CategoryBlock();
        $block
            ->setData($categoryResource->getQuery())
            ->render();
    }
}