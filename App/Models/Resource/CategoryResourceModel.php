<?php

namespace App\Models\Resource;

use App\Models\Database;

class CategoryResourceModel extends HandlerResourceModel
{
    protected $table = 'category';

    public function getAllCategories($productId): array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            "SELECT t1.name FROM {$this->table} AS t1 JOIN categories_of_products AS t2 
                    ON (t1.id=t2.category_id) JOIN product AS t3 ON (t2.product_id=t3.id) 
                     WHERE t3.id = ?;"
        );
        $query->execute([$productId]);
        return $query->fetchAll();
    }

    public function addCategory($category, $date, $parent = 1): void
    {
        $connection = Database::getConnection();
        if (!$this->checkIfExist($category)) {
            $query = $connection->prepare("INSERT INTO category (name, date, parent_id) VALUES (?, ?, ?);");
            $query->execute([$category, $date, $parent]);
        }
    }

    public function checkIfExist(string $input): ?int
    {
        foreach ($this->getQuery() as $row) {
            if ($row['name'] == $input) {
                return $row['id'];
            }
        }
        return null;
    }

    public function tieWithProduct($productId, $categoryId): void
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'INSERT INTO categories_of_products (product_id, category_id) VALUES (?, ?);'
        );
        $query->execute([$productId, $categoryId]);
    }

    public function clearCategories($productId): void
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'DELETE FROM categories_of_products WHERE product_id = ?;'
        );
        $query->execute([$productId]);
    }
}