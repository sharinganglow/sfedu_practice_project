<?php

namespace App\Blocks;

class FooterBlock extends AbstractBlockHandler
{
    public function render(): void
    {
        require_once APP_ROOT . '/views/constituents/footer.phtml';
    }
}
