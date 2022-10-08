<?php

namespace App\Controllers;

use App\Blocks\StorageBlock;
use App\Models\Database;
use App\Models\Resource\StorageResourceModel;
use App\Models\Entity\StorageModel;

class Storage
{
    public function execute(): void
    {
       $storageResource = new StorageResourceModel();
       $storage = new StorageModel();
       $storage->setData($storageResource->getQuery());

        $block = new StorageBlock();
        $block
            ->setStorage($storage)
            ->render();
    }
}