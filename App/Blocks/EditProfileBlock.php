<?php

namespace App\Blocks;

use App\Models\Resource\ClientResourceModel;

class EditProfileBlock
{
    private $template = APP_ROOT . '/views/editProfile.phtml';

    public function render(): void
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();
        $client = new ClientResourceModel();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}