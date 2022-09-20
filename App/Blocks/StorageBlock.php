<?php

namespace App\Blocks;

class StorageBlock extends AbstractBlockHandler
{
    private $data;
    private $template = APP_ROOT . '/views/storage.phtml';

    public function render()
    {
        $header = new HeaderBlock(3);
        $footer = new FooterBlock();

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