<?php

namespace App\Controllers;

use App\Blocks\AddClientBlock;
use App\Blocks\ClientBlock;
use App\Blocks\EditProfileBlock;
use App\Database\Database;
use App\Models\EditProfileModel;

class EditProfile extends AbstractController
{
    public function execute(): void
    {
        if (REQUEST_METHOD == 'GET') {
            $block = new EditProfileBlock();
            $block->render();
        } else {
            $model = new EditProfileModel();
            $model->updateProfile();
        }
    }
}