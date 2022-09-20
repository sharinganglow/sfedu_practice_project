<?php

namespace App\Blocks;

class ProductBlock extends AbstractBlockHandler
{
    private $data;
    private $template = APP_ROOT . '/views/product.phtml';

    public function render()
    {
        $header = new HeaderBlock(2);
        $footer = new FooterBlock();
        $category = new CategoryBlock();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData($data): self
    {
        $this->data = $data;
        return $this;
    }
}