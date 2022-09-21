<?php

namespace App\Blocks;

use App\Models\ClientModel;

class EditProfileBlock
{
    private $template = APP_ROOT . '/views/editProfile.phtml';

    public function render(): void
    {
        $header = new HeaderBlock(0);
        $footer = new FooterBlock();
        $client = new ClientModel();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}