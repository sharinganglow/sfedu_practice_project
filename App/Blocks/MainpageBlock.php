<?php

namespace App\Blocks;

class MainpageBlock extends Block
{
    protected $template = 'mainpage.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $header->setUnderlinedLink(1);
        $footer = new FooterBlock();

        require_once "{$this->getPath()}components/layout.phtml";
    }
}