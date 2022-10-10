<?php

namespace App\Controllers;

use App\Blocks\OrderBlock;
use App\Models\Database;
use App\Models\Entity\OrderModel;
use App\Models\Entity\OrdersModel;
use App\Models\Resource\OrderResourceModel;

class Order
{
    public function execute(): void
    {
        $orderResource = new OrderResourceModel();
        $orderItem = 3;
        $order = new OrderModel();
        $ordersList = new OrdersModel();

        foreach ($orderResource->initOrder($orderItem) as $item) {
            $ordersList->setOrder($item);
        }

        $block = new OrderBlock();
        $block
            ->setModel($ordersList)
            ->render();
    }
}