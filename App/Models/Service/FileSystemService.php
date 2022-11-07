<?php

namespace App\Models\Service;

use App\Models\Exceptions\LogicalException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FileSystemService
{
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function handleCsv(AbstractService $model, string $fileName): void
    {
        $stream = fopen($this->getPath() . '/' . $fileName, 'w+');

        fputcsv($stream, $model->getKeys());
        foreach ($model->getAll() as $row) {
            fputcsv($stream, $row);
        }
        fclose($stream);

        $this->checkResult($fileName);
    }

    public function handleXlsx(AbstractService $model, string $fileName): void
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

    protected function checkResult($fileName): void
    {
        if (!file_exists($this->getPath() . '/' . $fileName)) {
            throw new LogicalException('Не удалось создать файл');
        }
        echo 'Complete!' . PHP_EOL;
    }

    public function clearDirectory($dir): void
    {
        $list = scandir(APP_ROOT . $dir);
        unset($list[0], $list[1]);

        foreach ($list as $file) {
            if (is_dir($dir.$file)) {
                $this->clearDirectory($dir.$file.'/');
                rmdir($dir.$file);
            } else {
                unlink(APP_ROOT . $dir.$file);
            }
        }
    }

    protected function formatTable(Worksheet $worksheet): void
    {
        $worksheet->getColumnDimension('A')->setWidth(15);
        $worksheet->getColumnDimension('B')->setWidth(10);
        $worksheet->getColumnDimension('C')->setWidth(8);
        $worksheet->getColumnDimension('D')->setWidth(20);
        $worksheet->getColumnDimension('E')->setWidth(15);
        $worksheet->getColumnDimension('F')->setWidth(25);
    }
}