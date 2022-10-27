<?php

namespace App\Controllers\Api;

use App\Models\Exceptions\LogicalException;
use App\Models\Resource\StorageResourceModel;
use App\Models\Service\StorageService;

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
        $service = new StorageService();
        $this->display($service->getUnit($this->getId()));
    }

    public function getStorageList(): void
    {
        $service = new StorageService();
        $this->display($service->getAll());
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