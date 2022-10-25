<?php

namespace App\Controllers\Api;

use App\Models\Exceptions\LogicalException;
use App\Models\Resource\StorageResourceModel;

class StorageApi extends AbstractApi
{
    public function execute()
    {
        if ($this->isGet()) {
            if ($this->hasId()) {
                $this->getStorage();
            } else {
                $this->getStorageList();
            }
        }

        if ($this->isPut()) {
            $this->editStorage();
            $this->success();
        }

        if ($this->isPost()) {
            $this->addStorage();
            $this->success();
        }

        if ($this->isDelete()) {
            $this->deleteStorage();
            $this->success();
        }

        $this->noRoute();
    }

    public function getStorage(): void
    {
        $storageResource = new StorageResourceModel();

        $data = $storageResource->getRecordById($this->getId());

        $storage = ['address' => $data->getAddress()];
        $this->display($storage);
    }

    public function getStorageList(): void
    {
        $storageResource = new StorageResourceModel();
        $data = $storageResource->getQuery();

        $storages = [];
        foreach ($data as $row) {
            $unit = ['address' => $row->getAddress()];
            $storages [] = $unit;
        }

        $this->display($storages);
    }

    public function editStorage(): void
    {
        $input = $this->decodeJsonRequest();
        $storageResource = new StorageResourceModel();
        $storageResource->editStorage($input['address'], $this->getId());
    }

    public function addStorage(): void
    {
        $input = $this->decodeJsonRequest();
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