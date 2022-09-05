<?php

namespace App\Controllers;

use App\Blocks\MainpageBlock;

class Mainpage
{
    public function execute(): void
    {
        $block = new MainpageBlock();
        $block->render();
    }
}