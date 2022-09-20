<?php

namespace App\Blocks;

class MainpageBlock extends AbstractBlockHandler
{
    private $template = APP_ROOT . '/views/mainpage.phtml';

    public function render()
    {
        $header = new HeaderBlock(1);
        $footer = new FooterBlock();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}