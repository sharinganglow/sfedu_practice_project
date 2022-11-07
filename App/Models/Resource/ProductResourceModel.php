<?php

namespace App\Models\Resource;

use App\Models\Database;
use App\Models\Entity\CategoryModel;
use App\Models\Entity\Model;
use App\Models\Entity\ProductModel;

class ProductResourceModel extends HandlerResourceModel
{
    protected $table = 'product';

    public function getProductId($column, $value): ?int
    {
        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT id FROM {$this->table} WHERE {$column} = :value LIMIT 1;");
        $query->bindParam(':value', $value, \PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT);
        $query->execute();
        $data = $query->fetchColumn();

        return $data ?? null;
    }

    public function getQuery(): array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'SELECT *, product.id AS id_product
                    FROM product JOIN country ON (country.id=product.country_id)
                    JOIN brand ON (brand.id=product.brand_id)'
        );
        $query->execute();
        $data = $query->fetchAll();

        $result = [];
        foreach ($data as $datum) {
            $result [] = $this->buildItem($datum);
        }

        return $result;
    }

    public function getProductById($id): Model
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
        $data = $query->fetch();

        return $data ? $this->buildItem($data) : $this->buildEmptyItem();
    }

    public function addProduct(array $data): void
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'INSERT INTO product (name, price, country_id, brand_id, date) VALUES (?, ?, ?, ?, ?);'
        );
        $query->execute([
            $data['name'],
            $data['price'],
            $data['country'],
            $data['brand'],
            $data['date'] ?? null,
        ]);
    }

    public function editProduct(array $data): void
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'UPDATE product SET name = ?, price = ?, country_id = ?, brand_id = ?, date = ? 
               WHERE id = ?;'
        );
        $query->execute([
            $data['name'],
            $data['price'],
            $data['country'],
            $data['brand'],
            $data['date'],
            $data['id']
        ]);
    }

    protected function buildItem(array $data): ProductModel
    {
        return $this->buildEmptyItem()
            ->setName($data['name'] ?? '')
            ->setPrice($data['price'] ?? 0)
            ->setBrand($data['brand'] ?? '')
            ->setCountry($data['country'] ?? '')
            ->setDate($data['date'] ?? '')
            ->setId($data['id_product'] ?? 0);
    }

    protected function buildEmptyItem(): ProductModel
    {
        return new ProductModel();
    }
}
