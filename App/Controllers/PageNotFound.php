<?php

namespace App\Controllers;

use App\Blocks\PageNotFoundBlock;

class PageNotFound
{
    public function greetUser() :void
    {
        $block = new PageNotFoundBlock();
        $block->render();
    }
}