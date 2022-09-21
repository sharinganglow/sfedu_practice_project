<?php

namespace App\Models;

use App\Database\Database;

class CategoryModel extends HandlerModel
{
    private $data;
    protected $table = 'category';

    public function getAllCategories($productId): array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'SELECT t1.name FROM category AS t1 JOIN categories_of_products AS t2 
                    ON (t1.id=t2.category_id) JOIN product AS t3 ON (t2.product_id=t3.id) 
                     WHERE t3.id = ?;'
        );
        $query->execute([$productId]);
        return $query->fetchAll();
    }
}