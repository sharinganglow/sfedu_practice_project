<?php

namespace App\Controllers;

use App\Blocks\AddProductBlock;
use App\Models\Entity\ValidationModel;
use App\Models\Resource\BrandResourceModel;
use App\Models\Resource\CategoryResourceModel;
use App\Models\Resource\CountryResourceModel;
use App\Models\Resource\ProductResourceModel;
use App\Models\Service\CsrfTokenModel;
use App\Models\SessionModel;

class AddProduct extends AbstractController
{
    public function execute(): void
    {
        if ($this->getRequestMethod() == 'GET') {
            $token = new CsrfTokenModel();
            SessionModel::getInstance()->setCsrfToken($token->generateCsrfToken());

            $block = new AddProductBlock();
            $block->render();

        } else {
            $this->createProduct();
            $this->redirectTo('product');
        }
    }

    public function createProduct()
    {
        $validation = new ValidationModel();
        $validation->verifyToken($this->getCsrfToken());

        $this->executeProductAddition($this->getInputParams());
    }
}
