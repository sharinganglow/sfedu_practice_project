<?php

namespace App\Controllers\Api;

use App\Models\Entity\StoragesModel;
use App\Models\Exceptions\LogicalException;
use App\Models\Resource\StorageResourceModel;

class StorageApi extends AbstractApi
{
    public function execute()
    {
        if ($this->getRequestMethod() == 'GET') {
            if ($this->hasId()) {
                $this->getStorage();
            } else {
                $this->getStorageList();
            }
        }

        if ($this->getRequestMethod() == 'PUT') {
            $this->editStorage();
            header('Status: 200');
        }

        if ($this->getRequestMethod() == 'POST') {
            $this->addStorage();
            header('Status: 200');
        }

        if ($this->getRequestMethod() == 'DELETE') {
            $this->deleteStorage();
            header('Status: 200');
        }

        header('Status: 404');
    }

    public function getStorage(): void
    {
        $storageResource = new StorageResourceModel();
        $storageList = new StoragesModel();

        $storageList->setStorage($storageResource->getRecordById($this->getId()));
        $data = $storageList->getData()[0];

        $storage = ['address' => $data->getAddress()];
        $this->display($storage);
    }

    public function getStorageList(): void
    {
        $storageResource = new StorageResourceModel();

        $storages = [];
        foreach ($storageResource->getQuery() as $row) {
            $storage = new StoragesModel();
            $storage->setStorage($row);
            $data = $storage->getData()[0];

            $unit = ['address' => $data->getAddress()];
            $storages [] = $unit;
        }

        $this->display($storages);
    }

    public function editStorage(): void
    {
        $input = $this->decodeJson();
        $storageResource = new StorageResourceModel();
        $storageResource->editStorage($input['address'], $this->getId());
    }

    public function addStorage(): void
    {
        $input = $this->decodeJson();
        $storageResource = new StorageResourceModel();
        $storageResource->addStorage($input['address']);
    }

    public function deleteStorage(): void
    {
        try {
            $storageResource = new StorageResourceModel();
            $storageResource->deleteEntity($this->getId());
        } catch (LogicalException $exception) {
            throw new LogicalException('Ошибка при удалении сущности' . PHP_EOL);
        }
    }
}