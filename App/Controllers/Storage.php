<?php

namespace App\Controllers;

use App\Blocks\StorageBlock;
use App\Database\Database;

class Storage
{
    public function execute(): void
    {
        $connection = Database::getConnection();
        $query = $connection->prepare('SELECT * FROM storage');
        $query->execute();

        $block = new StorageBlock();
        $block
            ->setData($query->fetchAll())
            ->render();
    }
}