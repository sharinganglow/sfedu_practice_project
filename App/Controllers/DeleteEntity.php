<?php

namespace App\Controllers;

use App\Blocks\DeleteEntityBlock;
use App\Models\ProductModel;
use App\Models\Resource\ProductResourceModel;

class DeleteEntity extends AbstractController
{
    public function execute()
    {
        $productResource = new ProductResourceModel();
        $product = new ProductModel();
        $productResource->deleteProduct($_GET['id']);
        $this->redirectTo('product');
    }
}