<?php 

namespace App\Models;

use CodeIgniter\Model;


class Reporte_model extends Model
{
    protected $table = 'formulario_respuesta';

    
    public function getTest()
    {
        return $this->findAll();
    }


    public function getFormulariosResp()
    {
        $db = \Config\Database::connect();
        $sql =  "SELECT formulario_respuesta.idformresp, formulario_respuesta.rel_idusuario, users.username, formulario_respuesta.rel_idciudad, ciudad.idciudad, ciudad.nombre_ciudad, formulario_respuesta.rel_idzona, zona.idzona, zona.nombre_zona, formulario_respuesta.rel_idlugar, lugar.idlugar, lugar.nombre_lugar, formulario_respuesta.nombre_lugar AS nombre_de_lugar, formulario_respuesta.esta_abierto, formulario_respuesta.es_valido, formulario_respuesta.fecha_fc, formulario_respuesta.rel_iduiformulario   "
                ."FROM formulario_respuesta     "
                ."LEFT JOIN users ON users.id = formulario_respuesta.rel_idusuario     "
                ."LEFT JOIN ciudad ON ciudad.idciudad = formulario_respuesta.rel_idciudad     "
                ."LEFT JOIN zona ON zona.idzona = formulario_respuesta.rel_idzona     "
                ."LEFT JOIN lugar ON lugar.idlugar = formulario_respuesta.rel_idlugar     "
                ."WHERE formulario_respuesta.rel_iduiformulario = 1     "
                ."AND formulario_respuesta.es_valido = 1     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     ";
        $query   = $db->query($sql);
        $results = $query->getResult();
        $db->close();
        return $results;
    }

    //Leer todos los items de la DB ordenarlos para su despliegue
    public function getAllItems()
    {
        $db = \Config\Database::connect();
        $sql =  "SELECT *    "
                ."FROM item     "
                ."ORDER BY item.ordinal_item ASC     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     ";
        $query   = $db->query($sql);
        $results = $query->getResult();
        $db->close();
        return $results;
    }

    //Extraer los datos de un item del formulario de respuestas complementario
    //Datos de entrada: codigo del item, identificador del formulario de respuesta
    public function getItemDatos($codigo, $idformresp)
    {
        $codigo_item = $codigo;
        $rel_idformresp = $idformresp;
        $db = \Config\Database::connect();
        $sql =  "SELECT     ".$codigo_item."     "
                ."FROM formulario_respuesta_cmp    "
                ."WHERE formulario_respuesta_cmp.rel_idformresp = ?    "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     "
                ."     ";
        $query   = $db->query($sql, [$rel_idformresp, ]);
        $results = $query->getRowArray();
        $db->close();
        return $results;        
    }

        

}