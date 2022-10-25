<?php

namespace App\Models\Resource;

use App\Models\Database;
use App\Models\Entity\ClientModel;
use App\Models\Entity\CountryModel;
use App\Models\Entity\Model;

class CountryResourceModel extends HandlerResourceModel
{
    protected $table = 'country';

    public function addCountry(string $country): void
    {
        $connection = Database::getConnection();
        if (!$this->isExist($country)) {
            $query = $connection->prepare("INSERT INTO country (country) VALUE (?);");
            $query->execute([$country]);
        }
    }

    public function isExist(string $input): bool
    {
        foreach ($this->getQuery() as $row) {
            if ($row->getCountry() == $input) {
                return $row->getId();
            }
        }
        return false;
    }

    public function getByCountry($value): Model
    {
        $data = $this->getRowByColumn('country', $value);
        return $data;
    }

    protected function buildItem(array $data): Model
    {
        return $this->buildEmptyItem()
            ->setCountry($data['country'] ?? '')
            ->setId($data['id'] ?? 0);
    }

    protected function buildEmptyItem(): Model
    {
        return new CountryModel();
    }
}
