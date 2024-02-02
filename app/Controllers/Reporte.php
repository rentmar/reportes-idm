<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Reporte extends BaseController
{
    public function index()
    {
        //Instanciando la libreria
        $spreadsheet = new Spreadsheet;

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hola Mundo');
        $sheet->setCellValue('A2', 'Electronico');
        $sheet->setCellValue('A3', 'Descargable');



        $writer = new Xlsx($spreadsheet);
        $documento = ROOTPATH.'writable/nuevo-excel.xlsx';
        $writer->save($documento);

        header("Content-Type: application/vnd.ms-excel");

		header('Content-Disposition: attachment; filename="' . basename($documento) . '"');

		header('Expires: 0');

		header('Cache-Control: must-revalidate');

		header('Pragma: public');

		header('Content-Length:' . filesize($documento));

		flush();

		readfile($documento);

		exit;


        

    }
} 
