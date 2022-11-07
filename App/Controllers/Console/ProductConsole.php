<?php

namespace App\Controllers\Console;

use App\Models\Entity\ProductModel;
use App\Models\Exceptions\LogicalException;
use App\Models\Resource\ProductResourceModel;
use App\Models\Service\AbstractService;
use App\Models\Service\FileServiceFactory;
use App\Models\Service\FileSystemService;
use App\Models\Service\ProductService;
use http\Header;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ProductConsole extends AbstractExporter
{
    protected $entity = 'product_category';
    protected $path;

    public function execute($method): void
    {
        $fileName = $this->entity . '_' . $this->getDate() . '.' . $method;
        $model = new ProductService();
        $factory = new FileServiceFactory();
        $service = $factory->getObject($method, $this->getOutputDir());

        $service->handle($model, $fileName);
    }
}
