<?php

namespace App\Controllers;

use App\Models\SessionModel;

class LogOut extends AbstractController
{
    public function execute()
    {
        SessionModel::getInstance()
            ->start()
            ->destroy();

        $this->redirectTo();
    }
}