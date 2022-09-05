<?php

namespace App\Blocks;

class StorageBlock extends AbstractBlockHandler
{
    private $layout = APP_ROOT . '/views/storage.phtml';

    public function render()
    {
        $header = new HeaderBlock(3);
        $footer = new FooterBlock();

        require_once APP_ROOT . '/views/constituents/main-template.phtml';
    }

    public function getData(): array
    {
        return $data = [
            'Мр. Грилля 240', 'Мр. Грилля 260', 'Мясника и быка 260',
            'Мр. Грилля 240', 'Мр. Грилля 260', 'Мясника и быка 260',
            'Мр. Грилля 240', 'Мр. Грилля 260', 'Мясника и быка 260',
            'Мр. Грилля 240', 'Мр. Грилля 260', 'Мясника и быка 260',
        ];
    }
}