<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


// Rute untuk Login
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/doLogin', 'Auth::doLogin');
$routes->get('auth/logout', 'Auth::logout');

// Rute untuk Dashboard Gudang (Tanpa Filter, keamanan ada di GudangController)
$routes->get('gudang/dashboard', 'GudangController::dashboard');

// *Opsional: Jika ada role 'dapur'
$routes->get('dapur/dashboard', 'DapurController::dashboard');
