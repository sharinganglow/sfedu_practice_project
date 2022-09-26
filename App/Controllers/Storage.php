<?php

namespace App\Controllers;

use App\Blocks\StorageBlock;
use App\Models\Database;
use App\Models\Resource\StorageResourceModel;

class Storage
{
    public function execute(): void
    {
       $storage = new StorageResourceModel();

        $block = new StorageBlock();
        $block
            ->setData($storage->getQuery())
            ->render();
    }
}