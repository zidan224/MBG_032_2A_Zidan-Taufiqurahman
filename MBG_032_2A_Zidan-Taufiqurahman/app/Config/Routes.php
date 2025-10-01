<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ===========================================
// 1. RUTE DEFAULT DAN AUTENTIKASI (PUBLIK)
// ===========================================

// Rute Default
$routes->get('/', 'Home::index');

// Rute Autentikasi (Dikecualikan dari Filter 'auth')
$routes->get('login', 'Auth::login'); 
$routes->post('auth/doLogin', 'Auth::doLogin');
$routes->get('logout', 'Auth::logout');

// ===========================================
// 2. RUTE AREA GUDANG (DILINDUNGI)
// ===========================================

$routes->group('gudang', ['filter' => 'auth'], function ($routes) {
    
    // ----------------------------------------------------
    // *** RUTE DASHBOARD GUDANG ***
    // ----------------------------------------------------
    
    // URL: /gudang (Halaman utama dashboard/daftar bahan baku)
    // Fungsinya sebagai operasi READ (semua data)
    $routes->get('/', 'BahanBakuController::index');
    
    // Rute dashboard alternatif (opsional)
    $routes->get('dashboard', 'BahanBakuController::index');


    // ----------------------------------------------------
    // *** RUTE CRUD BAHAN BAKU ***
    // ----------------------------------------------------

    // 1. CREATE: Menampilkan form tambah data
    // URL: /gudang/create
    $routes->get('create', 'BahanBakuController::create'); 
    
    // 2. CREATE: Menyimpan data baru dari form
    // URL: /gudang/store (Hanya menerima metode POST)
    $routes->post('store', 'BahanBakuController::store'); 

    // 3. READ (Detail): Menampilkan detail satu item
    // URL: /gudang/show/123
    $routes->get('show/(:num)', 'BahanBakuController::show/$1');

    // 4. UPDATE: Menampilkan form edit data
    // URL: /gudang/edit/123
    $routes->get('edit/(:num)', 'BahanBakuController::edit/$1'); 
    
    // 5. UPDATE: Memproses perubahan data dari form
    // URL: /gudang/update/123 (Hanya menerima metode POST)
    $routes->post('update/(:num)', 'BahanBakuController::update/$1'); 
    
    // 6. DELETE: Menghapus data
    // URL: /gudang/delete/123 (Hanya menerima metode POST)
    $routes->post('delete/(:num)', 'BahanBakuController::delete/$1'); 
    
});