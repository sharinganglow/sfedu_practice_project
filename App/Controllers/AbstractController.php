<?php

namespace App\Controllers;

use App\Blocks\AddClientBlock;
use App\Blocks\AddProductBlock;
use App\Blocks\EditProductBlock;
use App\Blocks\EditProfileBlock;
use App\Models\Entity\ValidationModel;
use App\Models\Environment\Environment;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\BrandResourceModel;
use App\Models\Resource\CategoryResourceModel;
use App\Models\Resource\ClientResourceModel;
use App\Models\Resource\CountryResourceModel;
use App\Models\Resource\ProductResourceModel;
use App\Models\Service\CsrfTokenModel;
use App\Models\SessionModel;

abstract class AbstractController
{
    abstract function execute();

    public function getPostParam($name): string
    {
        return htmlspecialchars($_POST[$name]);
    }

    public function getInputParams(): ?array
    {
        return ($_POST) ?? null;
    }

    public function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public function getIdParam(): string
    {
        return $_GET['id'] ?? '';
    }

    public function getCsrfToken(): string
    {
        return $_POST['csrf_token'] ?? '';
    }

    public function redirectTo(string $path): void
    {
        $env = Environment::checkInstance();
        header("Location: {$env->getBaseUrl()}{$path}");
        exit();
    }

    public function executeGetClientForm(string $type): void
    {
        $token = new CsrfTokenModel();
        SessionModel::getInstance()->setCsrfToken($token->generateCsrfToken());

        if ($type == 'edit') {
            $block = new EditProfileBlock();
        } else {
            $block = new AddClientBlock();
        }

        $block->render();
    }

    public function executeGetProductForm(string $type): void
    {
        $token = new CsrfTokenModel();
        SessionModel::getInstance()->setCsrfToken($token->generateCsrfToken());

        if ($type == 'edit') {
            $block = new EditProductBlock();
            $productUnitResource = new ProductResourceModel();
            $block->setProduct($productUnitResource->getProductById($this->getIdParam()));

        } else {
            $block = new AddProductBlock();
        }

        $block->render();
    }
}
