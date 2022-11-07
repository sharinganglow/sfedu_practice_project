<?php

namespace App\Models\Service;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class XlsxHandler extends FileSystemService
{
    protected $path;

    public function handle(AbstractService $model, string $fileName): void
    {
        $data = $model->getAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $this->formatTable($sheet);

        $sheet->setTitle('Workssheet 1');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        array_unshift($data, $model->getKeys());

        $sheet->fromArray($data);
        $writer->save($this->getPath() . '/' . $fileName);

        $this->checkResult($fileName);
    }

    protected function formatTable(Worksheet $worksheet): void
    {
        $columnsWidth = [
            'A' => 15,
            'B' => 10,
            'C' => 8,
            'D' => 20,
            'E' => 15,
            'F' => 25,
        ];

        foreach ($columnsWidth as $column => $width) {
            $worksheet->getColumnDimension($column)->setWidth($width);
        }
    }
}