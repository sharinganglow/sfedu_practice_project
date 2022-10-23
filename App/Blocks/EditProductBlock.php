<?php

namespace App\Blocks;

class EditProductBlock extends Block
{
    protected $template = 'edit-product.phtml';

    public function render(): void
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();

        require_once "{$this->getPath()}components/layout.phtml";
    }
}