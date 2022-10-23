<?php

namespace App\Controllers\Api;

use App\Controllers\AbstractController;
use App\Models\Entity\ValidationModel;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;

abstract class AbstractApi extends AbstractController
{
    protected $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function hasId(): bool
    {
        return isset($this->id);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function glueCategories(array $categories, $delimiter = ','): string
    {
        return implode($delimiter, (array_column($categories, 'name')));
    }

    public function display($data): void
    {
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function decodeJson()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function handleClient(string $type): void
    {
        $validation = new ValidationModel();
        $clientResource = new ClientResourceModel();
        $input = $this->decodeJson();

        $isInputAccepted = $validation->isInputValid($input);
        if (!$validation->isEmailValid($input['email']) && $isInputAccepted) {
            throw new ValidationException('Ошибка при добавлении пользователя');
        }

        if ($type == 'edit') {
            $protectedPass = $clientResource->hashPassword($this->getPostParam('password'));
            $clientResource->editProfile(
                $input['name'],
                $input['surname'],
                $input['email'],
                $protectedPass,
                $this->getId()
            );
        } else {

            $protectedPass = $clientResource->hashPassword($this->getPostParam('password'));
            $clientResource->addClient(
                $input['name'],
                $input['surname'],
                $input['email'],
                $protectedPass
            );
        }
    }
}