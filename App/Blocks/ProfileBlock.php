<?php

namespace App\Blocks;

use App\Models\Resource\ClientResourceModel;
use App\Models\SessionModel;

class ProfileBlock extends Block
{
    protected $template = 'profile.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();
        $client = new ClientResourceModel();
        $session = SessionModel::getInstance();

        require_once "{$this->getPath()}components/layout.phtml";
    }
}