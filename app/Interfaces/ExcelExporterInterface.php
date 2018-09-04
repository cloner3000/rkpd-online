<?php

namespace App\Interfaces;

interface ExcelExporterInterface {
    public function import();
    public function export($view);
}