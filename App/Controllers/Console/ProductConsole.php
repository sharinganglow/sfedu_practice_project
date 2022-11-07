<?php

namespace App\Controllers\Console;

use App\Models\Entity\ProductModel;
use App\Models\Exceptions\LogicalException;
use App\Models\Resource\ProductResourceModel;
use App\Models\Service\AbstractService;
use App\Models\Service\FileSystemService;
use App\Models\Service\ProductService;
use http\Header;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ProductConsole extends AbstractConsole
{
    protected $entity = 'product_category';
    protected $path;

    public function execute($method): void
    {
        $fileExtension = $method;

        $fileName = $this->entity . '_' . $this->getDate() . '.' . $fileExtension;
        $model = new ProductService();
        $fileService = new FileSystemService($this->getPath());

        if ($method == 'csv') {
            $fileService->handleCsv($model, $fileName);
        } else {
            $fileService->handleXlsx($model, $fileName);
        }
    }
}
