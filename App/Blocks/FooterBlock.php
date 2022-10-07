<?php

namespace App\Blocks;

class FooterBlock extends Block
{
    public function render(): void
    {
        require_once "{$this->getPath()}components/footer.phtml";
    }
}
