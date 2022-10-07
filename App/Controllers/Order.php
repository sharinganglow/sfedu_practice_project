<?php

namespace App\Controllers;

use App\Blocks\OrderBlock;
use App\Models\Database;
use App\Models\Entity\OrderModel;
use App\Models\Resource\OrderResourceModel;

class Order
{
    public function execute(): void
    {
        $orderResource = new OrderResourceModel();
        $orderItem = 2;
        $order = new OrderModel();
        $order->setData($orderResource->initOrder($orderItem));

        $block = new OrderBlock();
        $block->render($order);
    }
}