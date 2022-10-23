<?php

namespace App\Controllers;

use App\Models\Entity\ValidationModel;

class EditProfile extends AbstractController
{
    public function execute(): void
    {
        $validation = new ValidationModel();

        if ($this->getRequestMethod() == 'GET') {
            $this->executeGetForm('edit');

        } elseif ($validation->isEmailValid($this->getPostParam('email'))) {

            $this->executePostForm('edit');
            $this->redirectTo('mainpage');
        }
    }
}