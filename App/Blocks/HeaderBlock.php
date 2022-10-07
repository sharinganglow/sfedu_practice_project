<?php

namespace App\Blocks;

use App\Models\SessionModel;

class HeaderBlock extends Block
{
    private $underlined = 0;

    public function render(): void
    {
        require_once "{$this->getPath()}components/header.phtml";
    }

    public function setUnderlinedLink($underlined): void
    {
        $this->underlined = $underlined;
    }
}