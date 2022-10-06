<?php

namespace App\Controllers;

use App\Blocks\LoginBlock;
use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class Login extends AbstractController
{
    public function execute()
    {
        $clientResource = new ClientResourceModel();

        if ($this->getRequestMethod() == 'GET') {
            $block = new LoginBlock();
            $block->render();
        } else {
            if ($clientResource->authenticate(
            $this->getPostParam('email'),
            $this->getPostParam('password')
            ) != null) {

                $session = SessionModel::getInstance();
                $session->start();
                $session->setClientId($clientResource->authenticate(
                    $this->getPostParam('email'),
                    $this->getPostParam('password')));
                $this->redirectTo('profile');
            }
        }
    }
}