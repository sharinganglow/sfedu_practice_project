<?php

namespace App\Models\Resource;

use App\Models\Database;

class CountryResourceModel extends HandlerResourceModel
{
    protected $table = 'country';

    public function addCountry(string $country): void
    {
        $connection = Database::getConnection();
        if (!$this->checkIfExist($country)) {
            $query = $connection->prepare("INSERT INTO country (country) VALUE (?);");
            $query->bindParam(1, $country, \PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT);
            $query->execute();
        }
    }

    public function checkIfExist(string $input): ?int
    {
        foreach ($this->getQuery() as $row) {
            if ($row['country'] == $input) {
                return $row['id'];
            }
        }
        return null;
    }
}
