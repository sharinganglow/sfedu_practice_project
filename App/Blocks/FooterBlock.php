<?php

namespace App\Blocks;

class FooterBlock extends AbstractBlock
{
    public function render(): void
    {
        require_once APP_ROOT . '/views/components/footer.phtml';
    }
}
