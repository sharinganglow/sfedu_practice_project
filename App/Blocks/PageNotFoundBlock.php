<?php

namespace App\Blocks;

class PageNotFoundBlock extends Block
{
    public function render()
    {
        require "{$this->getPath()}page-not-found.html";
    }
}