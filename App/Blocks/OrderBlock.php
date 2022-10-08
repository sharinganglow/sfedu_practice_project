<?php

namespace App\Blocks;

use App\Models\Database;
use App\Models\Entity\OrderModel;
use App\Models\Resource\OrderResourceModel;

class OrderBlock extends Block
{
    protected $data;
    protected $template = 'order.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();

        require_once "{$this->getPath()}components/layout.phtml";
    }

    public function setOrder(OrderModel $model): self
    {
        $this->data = $model->getData();
        return $this;
    }

    public function getOrder(): ?array
    {
        return $this->data ?? null;
    }
}