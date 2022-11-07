<?php

namespace App\Controllers\Console;

abstract class AbstractExporter
{
    abstract public function execute($method);

    public function getOutputDir(): string
    {
        return APP_ROOT . '/var/output';
    }

    protected function getDate()
    {
        return date('d_m_o__H_i');
    }
}