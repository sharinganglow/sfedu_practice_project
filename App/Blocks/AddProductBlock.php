<?php

namespace App\Blocks;

class AddProductBlock extends Block
{
    protected $template = 'add-product.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();

        require_once "{$this->getPath()}components/layout.phtml";
    }
}