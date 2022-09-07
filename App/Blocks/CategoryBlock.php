<?php

namespace App\Blocks;

class CategoryBlock extends AbstractBlockHandler
{
    private $data;
    private $layout = APP_ROOT . '/views/category.phtml';

    public function render()
    {
        $header = new HeaderBlock(4);
        $footer = new FooterBlock();

        require_once APP_ROOT . '/views/constituents/main-template.phtml';
    }

    public function getData(): array
    {
        return $this->data = [
                      'smartphone', 'ios', 'android', 'supersmartphone', 'linux',
                      'smartphone', 'ios', 'android', 'supersmartphone', 'linux',
                      'smartphone', 'ios', 'android', 'supersmartphone', 'linux',
                      'smartphone', 'ios', 'android', 'supersmartphone', 'linux',
        ];
    }

    public function setData($data): self
    {
        $this->data = $data;
        return $this;
    }
}