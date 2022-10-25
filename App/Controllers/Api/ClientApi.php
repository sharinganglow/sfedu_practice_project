<?php

namespace App\Controllers\Api;

use App\Models\Entity\ValidationModel;
use App\Models\Exceptions\LogicalException;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;

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
        $clientResource = new ClientResourceModel();
        $data = $clientResource->getClientById($this->getId());

        $client = [
            'name' => $data->getName(),
            'surname' => $data->getSurname(),
            'email' => $data->getEmail()
        ];
        $this->display($client);
    }

    public function getClientsList(): void
    {
        $clientResource = new ClientResourceModel();
        $data = $clientResource->getQuery();

        $clientsList = [];
        foreach ($data as $row) {
            $client = [
                'name' => $row->getName(),
                'surname' => $row->getSurname(),
                'email' => $row->getEmail()
            ];
            $clientsList [] = $client;
        }

        $this->display($clientsList);
    }

    public function editClient(): void
    {
        $this->executeClientHandle($this->decodeJsonRequest(), 'edit', true);
    }

    public function addClient(): void
    {
        $this->executeClientHandle($this->decodeJsonRequest(), 'add', true);
    }

    public function deleteClient(): void
    {
        try {
            $clientResource = new ClientResourceModel();
            $clientResource->deleteEntity($this->getId());
        } catch (LogicalException $exception) {
            throw new LogicalException('Ошибка при удалении сущности' . PHP_EOL);
        }
    }
}