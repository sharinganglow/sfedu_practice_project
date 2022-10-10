<?php

namespace App\Controllers;

use App\Blocks\AddClientBlock;
use App\Models\Database;
use App\Models\Service\CsrfTokenModel;
use App\Models\Entity\ValidationModel;
use App\Models\Exceptions\LogicalException;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class AddClient extends AbstractController
{
    public function execute(): void
    {
        $validation = new ValidationModel();

        if ($this->getRequestMethod() == 'GET') {
            $this->executeGetForm('add');

        } elseif ($validation->isEmailValid($this->getPostParam('email'))) {

            $this->executePostForm('add');
            $this->redirectTo('mainpage');
        }
    }
}