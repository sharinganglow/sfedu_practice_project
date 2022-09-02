<?php

namespace App\Controllers;

use App\Blocks\CategoryBlock;

class Category
{
    public function greetUser() :void
    {
        $block = new CategoryBlock();
        $block->render();
    }
}