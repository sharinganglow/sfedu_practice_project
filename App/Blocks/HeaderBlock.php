<?php

namespace App\Blocks;

class HeaderBlock extends AbstractBlockHandler
{
    private $focused;

    public function __construct($focused)
    {
        $this->focused = $focused;
    }

    public function render(): void
    {
        require_once APP_ROOT . '/views/components/header.phtml';
    }
}