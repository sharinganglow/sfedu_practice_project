<?php

namespace App\Blocks;

class AddClientBlock
{
    private $template = APP_ROOT . '/views/addClient.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}