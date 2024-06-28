<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');  
$routes->get('Jefeinmediato', 'EncuestaController::index');
$routes->post('Jefeinmediato', 'EncuestaController::index');
$routes->setAutoRoute(true);