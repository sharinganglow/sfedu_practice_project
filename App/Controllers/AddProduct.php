<?php

namespace App\Controllers;

use App\Blocks\AddProductBlock;
use App\Models\Entity\ProductModel;
use App\Models\Entity\ValidationModel;
use App\Models\Resource\BrandResourceModel;
use App\Models\Resource\CategoryResourceModel;
use App\Models\Resource\CountryResourceModel;
use App\Models\Resource\ProductResourceModel;
use App\Models\Service\CsrfTokenModel;
use App\Models\Service\ProductService;
use App\Models\SessionModel;

class AddProduct extends AbstractController
{
    public function execute(): void
    {
        if ($this->getRequestMethod() === 'GET') {
            $this->executeGetProductForm('add');

        } else {
            $this->createProduct();
            $this->redirectTo('product');
        }
    }

    public function createProduct()
    {
        $validation = new ValidationModel();
        $validation->verifyToken($this->getCsrfToken());

        $product = new ProductService();
        $product->add($this->getInputParams());
    }
}
