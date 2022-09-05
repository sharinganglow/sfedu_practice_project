<?php

namespace App\Controllers;

use App\Blocks\PageNotFoundBlock;

class PageNotFound
{
    public function execute(): void
    {
        $block = new PageNotFoundBlock();
        $block->render();
    }
}