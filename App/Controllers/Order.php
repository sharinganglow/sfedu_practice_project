<?php

namespace App\Controllers;

use App\Blocks\OrderBlock;
use App\Models\Database;
use App\Models\Resource\OrderResourceModel;

class Order
{
    public function execute(): void
    {
        $order = new OrderResourceModel();
        $orderItem = 2;

        $block = new OrderBlock();
        $block
            ->setData($order->initOrder($orderItem))
            ->render();
    }
}