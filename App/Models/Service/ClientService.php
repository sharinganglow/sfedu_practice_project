<?php

namespace App\Models\Service;

use App\Models\Entity\ValidationModel;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;

class ClientService extends AbstractService
{
    public function getUnit(int $id): array
    {
        $clientResource = new ClientResourceModel();
        $data = $clientResource->getClientById($id);

        $client = [
            'name' => $data->getName(),
            'surname' => $data->getSurname(),
            'email' => $data->getEmail()
        ];
        return $client;
    }

    public function getAll(): array
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

        return $clientsList;
    }

    public function handle(array $data, string $type, $apiId = false, $token = null): void
    {
        $validation = new ValidationModel();
        $model = new ClientResourceModel();

        $isFormAccepted = $validation->isInputValid($data);

        if (!$isFormAccepted) {
            throw new ValidationException('Ошибка при добавлении пользователя');
        }
        if (!$apiId) {
            $validation->verifyToken($token);
        }
        $protectedPass = $model->hashPassword($data['password']);

        $id = $apiId ? $apiId : $_GET['id'];
        $FormedData = [
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => $protectedPass,
            'id' => $id,
        ];

        if ($type == 'edit') {
            $model->editProfile($FormedData);
        } else {
            $model->addClient($FormedData);
        }
    }
}
