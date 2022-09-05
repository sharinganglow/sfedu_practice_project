<?php

namespace App\Blocks;

class CategoryBlock extends AbstractBlockHandler
{
    private $layout = APP_ROOT . '/views/category.phtml';

    public function render()
    {
        $header = new HeaderBlock(4);
        $footer = new FooterBlock();

        require_once APP_ROOT . '/views/constituents/main-template.phtml';
    }

    public function getData(): array
    {
        return $data = [
                      'smartphone', 'ios', 'android', 'supersmartphone', 'linux',
                      'smartphone', 'ios', 'android', 'supersmartphone', 'linux',
                      'smartphone', 'ios', 'android', 'supersmartphone', 'linux',
                      'smartphone', 'ios', 'android', 'supersmartphone', 'linux',
        ];
    }
}