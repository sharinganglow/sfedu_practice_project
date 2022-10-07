<?php

namespace App\Controllers;

use App\Blocks\AddClientBlock;
use App\Blocks\ClientBlock;
use App\Blocks\EditProfileBlock;
use App\Models\Database;
use App\Models\Exceptions\LogicalException;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class EditProfile extends AbstractController
{
    public function execute(): void
    {
        if ($this->getRequestMethod() == 'GET') {
            $block = new EditProfileBlock();
            $block->render();
        } elseif ($this->isEmailValid()) {
            $model = new ClientResourceModel();
            $model->updateProfile(
                $this->getPostParam('name'),
                $this->getPostParam('surname'),
                $this->getPostParam('email'),
                $this->getPostParam('password'),
                $this->getPostParam('re-password'),
            );

            $this->redirectTo('mainpage');
        }
    }
}