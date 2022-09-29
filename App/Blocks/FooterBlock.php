<?php

namespace App\Blocks;

class FooterBlock
{
    public function render(): void
    {
        require_once APP_ROOT . '/views/components/footer.phtml';
    }
}
