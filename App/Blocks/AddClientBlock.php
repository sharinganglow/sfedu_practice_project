<?php

namespace App\Blocks;

class AddClientBlock extends Block
{
    protected $template = 'addClient.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();

        require_once "{$this->getPath()}components/layout.phtml";
    }
}