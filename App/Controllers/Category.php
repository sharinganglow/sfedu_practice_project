<?php

namespace App\Controllers;

use App\Blocks\CategoryBlock;
use App\Models\Entity\CategoriesModel;
use App\Models\Entity\CategoryModel;
use App\Models\Database;
use App\Models\Resource\CategoryResourceModel;

class Category
{
    public function execute(): void
    {
        $categoryResource = new CategoryResourceModel();
        $category = new CategoryModel();
        $categoriesList = new CategoriesModel();

        foreach ($categoryResource->getQuery() as $item) {
            $categoriesList->setCategory($item);
        }

        $block = new CategoryBlock();
        $block
            ->setModel($categoriesList)
            ->render();
    }
}