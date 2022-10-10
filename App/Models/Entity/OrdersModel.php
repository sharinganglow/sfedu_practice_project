<?php

namespace App\Models\Entity;

class OrdersModel extends Model
{
    public function setOrder($row): self
    {
        $order = new OrderModel();
        $order->setName($row['name']);
        $order->setTotal($row['total']);

        $this->data [] = $order;
        return $this;
    }
}