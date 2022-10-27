<?php

namespace App\Models\Service;

use App\Models\Resource\StorageResourceModel;

class StorageService
{
    public function getAll(): array
    {
        $storageResource = new StorageResourceModel();
        $data = $storageResource->getQuery();

        $storages = [];
        foreach ($data as $row) {
            $unit = ['address' => $row->getAddress()];
            $storages [] = $unit;
        }

        return $storages;
    }

    public function getUnit($id): array
    {
        $storageResource = new StorageResourceModel();
        $data = $storageResource->getRecordById($id);

        $storage = ['address' => $data->getAddress()];
    }
}