<?php

namespace App\Blocks;

use App\Models\SessionModel;

class HeaderBlock
{
    private $focused = 0;

    public function render(): void
    {
        $isLogged = SessionModel::getInstance();
        require_once APP_ROOT . '/views/components/header.phtml';
    }

    public function setFocusedLink($focused): void
    {
        $this->focused = $focused;
    }
}