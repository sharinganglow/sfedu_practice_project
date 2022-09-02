<?php

namespace App\Blocks;

class PageNotFoundBlock
{
    public function render()
    {
        require APP_ROOT . '/views/page-not-found.html';
    }
}