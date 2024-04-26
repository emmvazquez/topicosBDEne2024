<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/clima','Clima::index');

$routes->get('clima/getUbicaciones','Clima::getUbicaciones');
$routes->get('clima/getClimaByCP','Clima::getClimaByCP');
$routes->get('clima/getClimaByFechas','Clima::getClimaByFechas');

$routes->get('/clima/formularioClima','Clima::formularioClima');
$routes->post('/clima/insertClima','Clima::insertClima');
