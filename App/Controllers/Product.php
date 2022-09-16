<?php

namespace App\Controllers;

use App\Blocks\ProductBlock;
use App\Database\Database;

class Product
{
    public function execute(): void
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'SELECT *
                    FROM product JOIN country ON (country.id=product.country_id)
                    JOIN brand ON (brand.id=product.brand_id)'
        );
        $query->execute();

        $block = new ProductBlock();
        $block
            ->setData($query->fetchAll())
            ->render();
    }
}