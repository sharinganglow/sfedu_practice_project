<?php

namespace App\Blocks;

use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class ProfileBlock
{
    private $template = APP_ROOT . '/views/profile.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $header->setFocusedLink(0);
        $footer = new FooterBlock();
        $client = new ClientResourceModel();
        $session = SessionModel::getInstance();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}