<?php
namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


class Example extends BaseController
{
    public function index()
    {
        //Instanciando la libreria
        $spreadsheet = new Spreadsheet;

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hola Mundo');



        $writer = new Xlsx($spreadsheet);
        $documento = ROOTPATH.'writable/nuevo-excel.xlsx';
        $writer->save($documento);


    }
} 


