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

// stok pada dashboard admin (gudang)
$routes->group('gudang', function($routes) {
    $routes->get('stok', 'StokController::index');
    $routes->get('stok/tambah', 'StokController::create'); // ✅ halaman form tambah
    $routes->post('stok/store', 'StokController::store');  // ✅ proses simpan
    $routes->post('stok/update/(:num)', 'StokController::update/$1'); // ✅ update stok
    $routes->get('stok/hapus/(:num)', 'StokController::delete/$1'); // ✅ hapus data
});
