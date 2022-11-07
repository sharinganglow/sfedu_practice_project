<?php

namespace App\Controllers\Console;

use App\Models\Exceptions\LogicalException;
use App\Models\Service\AbstractService;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

abstract class AbstractConsole
{
    protected $path;

    abstract public function execute($method);

    public function setPath($path): self
    {
        $this->path = $path ?? null;
        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path ?? $this->getOutputDir();
    }

    public function getOutputDir(): string
    {
        return APP_ROOT . '/var/output';
    }

    protected function getDate()
    {
        return date('d_m_o__H_i');
    }
}