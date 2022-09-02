<?php

namespace App\Controllers;

use App\Blocks\StorageBlock;

class Storage
{
    public function greetUser() :void
    {
        $block = new StorageBlock();
        $block->render();
    }
}