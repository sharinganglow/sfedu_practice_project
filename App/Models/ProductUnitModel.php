<?php

namespace App\Models;

use App\Database\Database;

class ProductUnitModel
{
    public function getQuery(): array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'SELECT *, product.id AS id_product
                    FROM product JOIN country ON (country.id=product.country_id)
                    JOIN brand ON (brand.id=product.brand_id)
                    WHERE product.id = :product_id;'
        );
        $query->bindParam(':product_id', $_GET['id'], \PDO::PARAM_INT | \PDO::PARAM_INPUT_OUTPUT);
        $query->execute();

        return $query->fetch();
    }
}