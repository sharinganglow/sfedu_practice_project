<?php

namespace App\Blocks;

class LoginBlock extends Block
{
    protected $template = 'login.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();

        require_once "{$this->getPath()}components/layout.phtml";
    }
}