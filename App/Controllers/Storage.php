<?php

namespace App\Controllers;

use App\Blocks\StorageBlock;
use App\Database\Database;
use App\Models\StorageModel;

class Storage
{
    public function execute(): void
    {
       $storage = new StorageModel();

        $block = new StorageBlock();
        $block
            ->setData($storage->getQuery())
            ->render();
    }
}