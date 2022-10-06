<?php

namespace App\Blocks;

class LoginBlock
{
    private $template = APP_ROOT . '/views/login.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $header->setFocusedLink(0);
        $footer = new FooterBlock();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}