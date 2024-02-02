<?php 

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models;
use App\Models\Reporte_model;

class ReporteGeneral extends BaseController
{
    public function index()
    {
        //Iniciar la libreria excel
        $spreadsheet = new Spreadsheet();
        //Iniciar el modelo del formulario-reporte
        $reporte = new Reporte_model();

        //Abrir el archivo
        $rutaArchivo = ROOTPATH.'assets/info/marcas-precios-db.xlsx';
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load($rutaArchivo);

        //Colocar el archivo para edicion
        $worksheet = $spreadsheet->getActiveSheet();

        /************************ Editar ************************************/

        //Formularios llenados
        $formularios_respuesta = $reporte->getFormulariosResp();
        //Items
        $items = $reporte->getAllItems();

        
        $eje_y = 2;
        
        $eje_x_seg = 'H';
        $eje_x_ter = 'I';
        $eje_y_seg = 2;
        foreach($formularios_respuesta as $fr):
            $eje_x_seg = 'H';
            $eje_x_ter = 'I';

            $eje_x_cuarto = 'BR' ;
            $eje_x_quinto = 'BS' ;
            $eje_x_sexto = 'BT';
            //$eje_y_seg = 2;
            $worksheet->getCell('A'.$eje_y)->setValue($fr->idformresp);
            $worksheet->getCell('B'.$eje_y)->setValue($fr->username);
            $worksheet->getCell('C'.$eje_y)->setValue($fr->nombre_ciudad);
            $worksheet->getCell('D'.$eje_y)->setValue($fr->nombre_zona);
            $worksheet->getCell('E'.$eje_y)->setValue($fr->nombre_lugar);
            $worksheet->getCell('F'.$eje_y)->setValue($fr->nombre_de_lugar);
            $worksheet->getCell('G'.$eje_y)->setValue($fr->fecha_fc);
            //rutina combinada con items
            foreach($items as $i):
                $codigo =  $i->codigo_item;
                $idformresp = $fr->idformresp;
                //Extrayendo las marcas y precios de un item por codigo y form de respuesta
                $marca_codigo = $reporte->getItemDatos($codigo, $idformresp);
                //Extraer los datos - json nativo
                $marca_json = $marca_codigo[$codigo];
                //Convertir a objetos
                $marca = json_decode($marca_json);
                //Ajuste del offset del eje secundario
                $eje_y_seg = $eje_y;               
                
                foreach($marca as $m)
                {
                    //Imprimir el precio del item
                    //$worksheet->getCell($eje_x_seg.$eje_y_seg)->setValue('precio'.$codigo);
                    //Imprimir la marca del Item
                    //$worksheet->getCell($eje_x_ter.$eje_y_seg)->setValue('marca'.$codigo);
                 
                    if($i->iditem <=31):
                        //Imprimir el precio del item
                        $worksheet->getCell($eje_x_seg.$eje_y_seg)->setValue($m->idmarca);
                        //Imprimir la marca del Item
                        $worksheet->getCell($eje_x_ter.$eje_y_seg)->setValue($m->marca.'-'.$codigo.'-'.$idformresp);
                        $eje_y_seg++;
                    else:
                        //Imprimir el precio del item
                        $worksheet->getCell($eje_x_cuarto.$eje_y_seg)->setValue($m->idmarca);
                        //Imprimir la marca del Item
                        $worksheet->getCell($eje_x_quinto.$eje_y_seg)->setValue($m->marca.'-'.$codigo.'-'.$idformresp);
                        $worksheet->getCell($eje_x_sexto.$eje_y_seg)->setValue($m->marca.'-'.$codigo.'-'.$idformresp);
                        

                        $eje_y_seg++;                       
                    endif;
                }
                //Ajuste offset en el eje X secundario
                $eje_x_seg++;
                $eje_x_seg++;
                //Ajuste offset eje x terciario
                $eje_x_ter++;
                $eje_x_ter++;
                if($i->iditem > 31){

                    $eje_x_cuarto++;
                    $eje_x_cuarto++;
                    $eje_x_cuarto++;

                    $eje_x_quinto++;
                    $eje_x_quinto++;
                    $eje_x_quinto++;


                    $eje_x_sexto++;
                    $eje_x_sexto++;
                    $eje_x_sexto++;
                }

            
            
            endforeach;           
                       
            $eje_y = $eje_y_seg;            
        endforeach;    
        
        
        /*$worksheet->getCell('A2')->setValue('Codeigniter');
        $worksheet->getCell('A3')->setValue('4');
        $worksheet->getCell('A4')->setValue('Descarga');*


        /************************ Fin Editar ************************************/

        //Escribir el documento
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $documento = ROOTPATH.'writable/reporte-general.xlsx';
        $writer->save($documento);

        //Descarga
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

    public function departamento()
    {

    }

}