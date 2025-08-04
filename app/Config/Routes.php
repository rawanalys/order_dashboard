<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('csvimport/importUsers', 'CsvImport::importUsers');
$routes->get('csvimport/importOrders', 'CsvImport::importOrders');

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->get('customers', 'CustomerApi::index');
    $routes->get('customers/(:num)', 'CustomerApi::show/$1');
});
