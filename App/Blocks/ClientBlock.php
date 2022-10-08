<?php

namespace App\Blocks;

use App\Models\Entity\ClientModel;
use App\Models\Database;

class ClientBlock extends Block
{
    protected $data;
    protected $template = 'client.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $header->setUnderlinedLink(5);
        $footer = new FooterBlock();

        require_once "{$this->getPath()}components/layout.phtml";
    }

    public function setClient(ClientModel $model): self
    {
        $this->data = $model->getData();
        return $this;
    }

    public function getClient(): ?array
    {
        return $this->data ?? null;
    }
}