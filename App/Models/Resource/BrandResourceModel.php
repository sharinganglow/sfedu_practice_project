<?php

namespace App\Models\Resource;

use App\Models\Database;

class BrandResourceModel extends HandlerResourceModel
{
    protected $table = 'brand';

    public function addBrand(string $brand): void
    {
        $connection = Database::getConnection();
        if (!$this->checkIfExist($brand)) {
            $query = $connection->prepare("INSERT INTO brand (brand) VALUE (?);");
            $query->bindParam(1, $brand, \PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT);
            $query->execute();
        }
    }

    public function checkIfExist(string $input): ?int
    {
        foreach ($this->getQuery() as $row) {
            if ($row['brand'] == $input) {
                return $row['id'];
            }
        }
        return null;
    }
}
