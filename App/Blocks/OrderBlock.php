<?php

namespace App\Blocks;

use App\Models\Database;
use App\Models\Entity\Model;
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

    public function setOrder(Model $model): self
    {
        $this->model = $model;
        return $this;
    }

    public function getOrder(): Model
    {
        return $this->model;
    }
}