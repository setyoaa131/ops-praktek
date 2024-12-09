<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->post('login/process', 'Home::processLogin');
$routes->get('dashboard', 'ProdukController::tampilProduk', ['filter' => 'auth']);
$routes->get('tambah_produk', 'Home::tambahProduk', ['filter' => 'auth']);
$routes->get('profil', 'Home::profil', ['filter' => 'auth']);
$routes->get('logout', 'Home::logout');
$routes->post('simpanProduk', 'ProdukController::simpanProduk', ['filter' => 'auth']);
$routes->get('edit-produk/(:num)', 'ProdukController::editProduk/$1', ['filter' => 'auth']);
$routes->post('update-produk/(:num)', 'ProdukController::updateProduk/$1', ['filter' => 'auth']);
