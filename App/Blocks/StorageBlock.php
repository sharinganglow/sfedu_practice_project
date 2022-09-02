<?php

namespace App\Blocks;

class StorageBlock
{
    public function render()
    {
        require APP_ROOT . '/views/storage.phtml';
    }

    public function getData() :array
    {
        return $data = [
            'address' => 'Мр. Грилля 240', 'Мр. Грилля 260', 'Мясника и быка 260',
            'Мр. Грилля 240', 'Мр. Грилля 260', 'Мясника и быка 260',
            'Мр. Грилля 240', 'Мр. Грилля 260', 'Мясника и быка 260',
            'Мр. Грилля 240', 'Мр. Грилля 260', 'Мясника и быка 260',
        ];
    }

    public function setData()
    {
    }
}