<?php

namespace App\Blocks;

class PageNotFoundBlock extends AbstractBlockHandler
{
    public function render()
    {
        require APP_ROOT . '/views/page-not-found.html';
    }
}