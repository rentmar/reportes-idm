<?php

use App\Controllers\ReporteGeneral;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/excel', 'Example::index');
$routes->get('/reporte', 'Reporte::index');
$routes->get('/reportegeneral', 'ReporteGeneral::index');
$routes->get('/prueba','Prueba::index');
