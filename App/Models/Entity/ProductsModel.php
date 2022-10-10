<?php

namespace App\Models\Entity;

class ProductsModel extends Model
{
    public function setProduct($row): self
    {
        $product = new ProductModel();
        $product->setName($row['name']);
        $product->setPrice($row['price']);
        $product->setCountry($row['country']);
        $product->setBrand($row['brand']);
        $product->setDate($row['date']);
        $product->setId($row['id_product']);

        $this->data [] = $product;
        return $this;
    }
}