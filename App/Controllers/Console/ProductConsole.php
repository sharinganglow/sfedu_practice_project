<?php

namespace App\Controllers\Console;

use App\Models\Entity\ProductModel;
use App\Models\Exceptions\LogicalException;
use App\Models\Resource\ProductResourceModel;
use App\Models\Service\AbstractService;
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

        $date = new \DateTime();
        $date = date('d_m_o__H_i', $date->getTimestamp());
        $fileName = $this->entity . '_' . $date . '.' . $fileExtension;
        $model = new ProductService();
        $this->setLocation(APP_ROOT . '/var/output/', $fileName);

        if ($method == 'csv') {
            $this->handleCsv($model);
        } else {
            $this->handleXlsx($model);
        }
    }
}
