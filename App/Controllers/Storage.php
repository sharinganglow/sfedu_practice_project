<?php

namespace App\Controllers;

use App\Blocks\StorageBlock;
use App\Models\Database;
use App\Models\Entity\StoragesModel;
use App\Models\Resource\StorageResourceModel;
use App\Models\Entity\StorageModel;

class Storage
{
    public function execute(): void
    {
       $storageResource = new StorageResourceModel();
       $storageList = new StoragesModel();

       foreach ($storageResource->getQuery() as $item) {
           $storageList->setStorage($item);
       }

        $block = new StorageBlock();
        $block
            ->setModel($storageList)
            ->render();
    }
}
