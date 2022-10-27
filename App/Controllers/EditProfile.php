<?php

namespace App\Controllers;

use App\Models\Entity\ValidationModel;
use App\Models\Service\ClientService;

class EditProfile extends AbstractController
{
    public function execute(): void
    {
        $validation = new ValidationModel();

        if ($this->getRequestMethod() === 'GET') {
            $this->executeGetClientForm('edit');

        } elseif ($validation->isEmailValid($this->getPostParam('email'))) {

            $service = new ClientService();
            $service->handle($this->getInputParams(), 'edit', false, $this->getCsrfToken());
            $this->redirectTo('mainpage');
        }
    }
}