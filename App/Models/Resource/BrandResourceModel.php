<?php

namespace App\Models\Resource;

use App\Models\Database;
use App\Models\Entity\BrandModel;
use App\Models\Entity\CategoryModel;
use App\Models\Entity\ClientModel;
use App\Models\Entity\Model;

class BrandResourceModel extends HandlerResourceModel
{
    protected $table = 'brand';

    public function addBrand(string $brand): ?Model
    {
        $connection = Database::getConnection();
        if (!$this->isExist($brand)) {
            $query = $connection->prepare('INSERT INTO brand (brand) VALUE (?);');
            $query->execute([$brand]);

            $model = new BrandModel();
            $model
                ->setBrand($brand)
                ->setId($connection->lastInsertId());
            return $model;
        }
        return $this->getByBrand($brand);
    }

    public function isExist(string $input): bool
    {
        foreach ($this->getQuery() as $row) {
            if ($row->getBrand() == $input) {
                return $row->getId();
            }
        }
        return false;
    }

    public function getByBrand($value): Model
    {
        $data = $this->getRowByColumn('brand', $value);
        return $data;
    }

    protected function buildItem(array $data): Model
    {
        return $this->buildEmptyItem()
            ->setBrand($data['brand'] ?? '')
            ->setId($data['id'] ?? 0);
    }

    protected function buildEmptyItem(): Model
    {
        return new BrandModel();
    }
}
