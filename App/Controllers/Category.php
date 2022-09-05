<?php

namespace App\Controllers;

use App\Blocks\CategoryBlock;

class Category
{
    public function execute(): void
    {
        $block = new CategoryBlock();
        $block->render();
    }
}