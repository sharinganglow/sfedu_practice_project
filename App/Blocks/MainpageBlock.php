<?php

namespace App\Blocks;

class MainpageBlock
{
    private $template = APP_ROOT . '/views/mainpage.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $header->setFocusedLink(1);
        $footer = new FooterBlock();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}