<?php

namespace App\Controllers;

use App\Blocks\MainpageBlock;

class Mainpage
{
    public function greetUser() :void
    {
        $block = new MainpageBlock();
        $block->render();
    }
}