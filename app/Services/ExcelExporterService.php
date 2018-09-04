<?php

namespace App\Services;

use App\Interfaces\ExcelExporterInterface;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExporterService implements ExcelExporterInterface {

    public function import()
    {
        // TODO: Implement import() method.
    }

    public function export($view)
    {
        Excel::create('New file', function($excel) use ($view) {

            $excel->sheet('New sheet', function($sheet) use ($view) {

                $sheet->loadView($view);

            });

        });
    }
}