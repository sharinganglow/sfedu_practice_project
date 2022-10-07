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
        $category = new CategoryModel();
        $category->setData($categoryResource->getQuery());

        $block = new CategoryBlock();
        $block->render($category);
    }
}