<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');
$routes->get('/transaksi', 'Transaksi::index');
$routes->delete('/transaksi/(:segment)', 'Transaksi::delete/$1');
$routes->get('/admin', 'Admin::index',['filter'=>'cek']);
$routes->get('/penjualan', 'Penjualan::index',['filter'=>'cek']);
$routes->post('/penjualan/cart', 'Penjualan::addtocart');
$routes->delete('/penjualan/cart/(:segment)', 'Penjualan::delete/$1');
$routes->post('/penjualan/transaksi', 'Penjualan::Transaksi');
$routes->get('/setting', 'Admin::setting');
$routes->get('/produk', 'Barang::index');
$routes->post('/produk/create', 'Barang::create');
$routes->post('/produk/update/(:segment)', 'Barang::update/$1');
$routes->delete('/produk/(:segment)', 'Barang::delete/$1');
$routes->get('/satuan', 'Satuan::index');
$routes->post('/satuan/create', 'Satuan::create');
$routes->post('/satuan/update/(:segment)', 'Satuan::update/$1');
$routes->delete('/satuan/(:segment)', 'Satuan::delete/$1');
$routes->get('/user', 'User::index');
$routes->post('/user/create', 'User::create');
$routes->post('/user/update/(:segment)', 'User::update/$1');
$routes->delete('/user/(:segment)', 'User::delete/$1');

//Api
$routes->resource('api/penjualan',['controller'=>'Api\Penjualan']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
