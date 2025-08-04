<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('csvimport/importUsers', 'CsvImport::importUsers');
$routes->get('csvimport/importOrders', 'CsvImport::importOrders');
