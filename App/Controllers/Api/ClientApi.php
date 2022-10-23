<?php

namespace App\Controllers\Api;

use App\Models\Entity\ClientsModel;
use App\Models\Entity\ValidationModel;
use App\Models\Exceptions\LogicalException;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;

class ClientApi extends AbstractApi
{
    public function execute()
    {
        if ($this->getRequestMethod() == 'GET') {
            if ($this->hasId()) {
                $this->getClient();
            } else {
                $this->getClientsList();
            }
        }

        if ($this->getRequestMethod() == 'PUT') {
            $this->editClient();
            header('Status: 200');
        }

        if ($this->getRequestMethod() == 'POST') {
            $this->addClient();
            header('Status: 200');
        }

        if ($this->getRequestMethod() == 'DELETE') {
            $this->deleteClient();
            header('Status: 200');
        }

        header('Status: 404');
    }

    public function getClient(): void
    {
        $clientResource = new ClientResourceModel();
        $client = new ClientsModel();

        $client->setClient($clientResource->getClientById($this->getId()));
        $data = $client->getData()[0];

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

        $clientsList = [];
        foreach ($clientResource->getQuery() as $row) {
            $client = new ClientsModel();
            $client->setClient($row);
            $data = $client->getData()[0];

            $client = [
                'name' => $data->getName(),
                'surname' => $data->getSurname(),
                'email' => $data->getEmail()
            ];
            $clientsList [] = $client;
        }

        $this->display($clientsList);
    }

    public function editClient(): void
    {
        $this->handleClient('edit');
    }

    public function addClient(): void
    {
        $this->handleClient('add');
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