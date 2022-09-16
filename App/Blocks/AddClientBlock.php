<?php

namespace App\Blocks;

class AddClientBlock extends AbstractBlockHandler
{
    private $template = APP_ROOT . '/views/addClient.phtml';

    public function render()
    {
        $header = new HeaderBlock(0);
        $footer = new FooterBlock();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}