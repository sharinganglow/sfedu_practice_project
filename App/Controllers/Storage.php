<?php

namespace App\Controllers;

use App\Blocks\StorageBlock;

class Storage
{
    public function execute(): void
    {
        $block = new StorageBlock();
        $block->render();
    }
}