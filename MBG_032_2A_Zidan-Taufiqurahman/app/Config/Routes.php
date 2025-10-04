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
$routes->get('gudang/setujui/(:num)', 'GudangController::setujui/$1');
$routes->get('gudang/tolak/(:num)', 'GudangController::tolak/$1');

// role 'dapur'
$routes->group('dapur', function($routes) {
    // Dashboard dapur
    $routes->get('dashboard', 'DapurController::dashboard');
    // Halaman daftar permintaan bahan
    $routes->get('permintaan', 'DapurController::permintaan');
    // Form tambah permintaan bahan
    $routes->get('permintaan/tambah', 'DapurController::createPermintaan');
    // Simpan permintaan bahan
    $routes->post('storePermintaan', 'DapurController::storePermintaan');

});

// stok pada dashboard admin (gudang)
$routes->group('gudang', function($routes) {
    $routes->get('stok', 'StokController::index');
    $routes->get('stok/tambah', 'StokController::create');
    $routes->post('stok/store', 'StokController::store');
    $routes->get('stok/edit/(:num)', 'StokController::edit/$1');
    $routes->post('stok/update/(:num)', 'StokController::update/$1');
    $routes->get('stok/hapus/(:num)', 'StokController::delete/$1');
});







