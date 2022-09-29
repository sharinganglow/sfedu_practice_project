<?php

namespace App\Blocks;

class HeaderBlock
{
    private $focused = 0;

    public function render(): void
    {
        require_once APP_ROOT . '/views/components/header.phtml';
    }

    public function setFocusedLink($focused): void
    {
        $this->focused = $focused;
    }
}