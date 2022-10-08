<?php

namespace App\Blocks;

use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class EditProfileBlock extends Block
{
    protected $template = 'editProfile.phtml';

    public function render(): void
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();

        require_once "{$this->getPath()}components/layout.phtml";
    }
}