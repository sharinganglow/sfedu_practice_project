<?php

namespace App\Blocks;

class MainpageBlock
{
    public function render()
    {
        require APP_ROOT . '/views/mainpage.phtml';
    }
}