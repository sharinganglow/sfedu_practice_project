<?php

namespace App\Controllers;

use App\Blocks\CategoryBlock;
use App\Models\Database;
use App\Models\Resource\CategoryResourceModel;

class Category
{
    public function execute(): void
    {
        $category = new CategoryResourceModel();

        $block = new CategoryBlock();
        $block
            ->setData($category->getQuery())
            ->render();
    }
}