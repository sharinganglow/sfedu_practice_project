<?php

namespace App\Controllers;

use App\Blocks\CategoryBlock;
use App\Database\Database;

class Category
{
    public function execute(): void
    {
        $connection = Database::getConnection();
        $query = $connection->prepare('SELECT * FROM category');
        $query->execute();

        $block = new CategoryBlock();
        $block
            ->setData($query->fetchAll())
            ->render();
    }
}