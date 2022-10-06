<?php

namespace App\Blocks;

use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class EditProfileBlock
{
    private $template = APP_ROOT . '/views/editProfile.phtml';

    public function render(): void
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();
        $client = new ClientResourceModel();
        $session = SessionModel::getInstance();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}