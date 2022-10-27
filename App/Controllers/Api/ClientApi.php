<?php

namespace App\Controllers\Api;

use App\Models\Cache\FileCache;
use App\Models\Entity\ValidationModel;
use App\Models\Exceptions\LogicalException;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;
use App\Models\Service\CategoryService;
use App\Models\Service\ClientService;

class ClientApi extends AbstractApi
{
    public function execute()
    {
        if ($this->isGet()) {
            if ($this->hasId()) {
                $this->getClient();
            } else {
                $this->getClientsList();
            }
        }

        if ($this->isPut()) {
            $this->editClient();
            $this->success();
        }

        if ($this->isPost()) {
            $this->addClient();
            $this->success();
        }

        if ($this->isDelete()) {
            $this->deleteClient();
            $this->success();
        }

        $this->noRoute();
    }

    public function getClient(): void
    {
        $service = new ClientService();
        $this->display($this->getData('cached_client', $service));
    }

    public function getClientsList(): void
    {
        $service = new ClientService();
        $this->display($this->getData('cached_clients_list', $service));
    }

    public function editClient(): void
    {
        $service = new ClientService();
        $cache = new FileCache();
        $service->handle($this->decodeJsonRequest(), 'edit', $this->getId());

        $data = $service->getAll();
        $cache->set('cached_products_list', $data);
        $data = $service->getUnit($this->getId());
        $cache->set('cached_product', $data, $this->getId());
    }

    public function addClient(): void
    {
        $service = new ClientService();
        $cache = new FileCache();
        $service->handle($this->decodeJsonRequest(), 'add', $this->getId());

        $data = $service->getAll();
        $cache->set('cached_products_list', $data);
    }

    public function deleteClient(): void
    {
        try {
            $service = new ClientService();
            $cache = new FileCache();
            $clientResource = new ClientResourceModel();
            $clientResource->deleteEntity($this->getId());

            $data = $service->getAll();
            $cache->set('cached_clients_list', $data);
            $cache->delete('cached_client', $this->getId());

        } catch (LogicalException $exception) {
            throw new LogicalException('Ошибка при удалении сущности' . PHP_EOL);
        }
    }
}