<?php

namespace App\Controllers;

use App\Blocks\CategoryBlock;
use App\Database\Database;
use App\Models\CategoryModel;

class Category
{
    public function execute(): void
    {
        $category = new CategoryModel();

        $block = new CategoryBlock();
        $block
            ->setData($category->getQuery())
            ->render();
    }
}