<?php

namespace App\Controllers;

use App\Blocks\OrderBlock;
use App\Database\Database;
use App\Models\OrderModel;

class Order
{
    public function execute(): void
    {
        $order = new OrderModel();

        $block = new OrderBlock();
        $block
            ->setData($order->initOrder(2))
            ->render();
    }
}