<?php
 namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Reporte_model;


class Prueba extends BaseController
{

    public function index()
    {
        echo "Hola prueba";
        echo '<br><br><br>';

        $reporte = new Reporte_model();

        $data = $reporte->getFormulariosResp();


        var_dump($data);

        echo '<br><br><br>';
        echo 'CONTADOR EJE X';
        $eje_y = 'A';
        echo '<br><br>';
        for ($i = 1; $i <= 100; $i++) {
            echo $eje_y++;
            echo '<br>';
        }


        //Extraer los items de la base de datos
        echo '<br><br><br>';
        echo "ITEMS";
        echo '<br><br>';
        $items = $reporte->getAllItems();


        //Imprimir lpos codigos de los items
        foreach($items as $i):
            echo $i->codigo_item;
            echo '<br>'; 
        endforeach;    


        
        echo '<br><br><br>';

        //Extraer el complemento de un formulario de respuestas
        //Datos de entrada: codigo del item, identificador del formulario de respuesta
        $marcas_codigo = $reporte->getItemDatos('A1', 1);
        var_dump($marcas_codigo);

        echo "<br><br>";
        $marcaPrecio = $marcas_codigo['A1'];


        echo '<br><br><br>';
        echo 'Ruitna combinada';
        echo '<br>';
        
        //rutina combinada con items
        foreach($items as $i):
            //echo $i->codigo_item;
            //echo '<br>';
            $codigo =  $i->codigo_item;
            $idformresp = 1;
            echo $codigo;
            echo "<br>";
            $marca_codigo = $reporte->getItemDatos($codigo, $idformresp);
            var_dump($marca_codigo);
            echo "<br>";
            //Extraer los datos json
            $marca_json = $marca_codigo[$codigo];
            echo $codigo." JSON: ";
            echo "<br>";
            echo $marca_json;
            echo "<br>";
            //Convertir a objetos e imprimir
            $marca = json_decode($marca_json);
            echo $codigo." objeto: ";
            echo "<br>";
            var_dump($marca);
            echo "<br>";



            echo "<br><br>";
        endforeach;    











    }

    

}