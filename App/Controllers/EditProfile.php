<?php

namespace App\Controllers;

use App\Blocks\AddClientBlock;
use App\Blocks\ClientBlock;
use App\Blocks\EditProfileBlock;
use App\Models\Database;
use App\Models\Service\CsrfTokenModel;
use App\Models\Entity\ValidationModel;
use App\Models\Exceptions\LogicalException;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

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