<?php

namespace App\Models\Resource;

use App\Models\Database;

class ProductResourceModel extends HandlerResourceModel
{
    public function getQuery(): array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'SELECT *, product.id AS id_product
                    FROM product JOIN country ON (country.id=product.country_id)
                    JOIN brand ON (brand.id=product.brand_id)'
        );
        $query->execute();

        return $query->fetchAll();
    }

    public function getProductById($id): array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'SELECT *, product.id AS id_product
                    FROM product JOIN country ON (country.id=product.country_id)
                    JOIN brand ON (brand.id=product.brand_id)
                    WHERE product.id = :product_id;'
        );
        $query->bindParam(':product_id', $id, \PDO::PARAM_INT | \PDO::PARAM_INPUT_OUTPUT);
        $query->execute();

        return $query->fetch();
    }

    public function deleteProduct($product_id): void
    {
        $connection = Database::getConnection();
        $this->deleteRecord('storage_item', $product_id);
        $this->deleteRecord('order_item', $product_id);
        $this->deleteRecord('categories_of_products', $product_id);
        $this->deleteRecord('product', $product_id, 'id');
    }
}