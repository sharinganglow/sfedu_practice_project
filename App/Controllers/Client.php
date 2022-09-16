<?php

namespace App\Controllers;

use App\Blocks\ClientBlock;
use App\Database\Database;

class Client
{
    public function execute(): void
    {
        $connection = Database::getConnection();
        $query = $connection->prepare('SELECT * FROM client');
        $query->execute();

        $block = new ClientBlock();
        $block
            ->setData($query->fetchAll())
            ->render();
    }
}