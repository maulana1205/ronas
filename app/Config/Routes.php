<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('dashboard/index', 'Dashboard::index');
$routes->get('barang/index', 'Barang::index');
$routes->get('barang/create', 'Barang::create');
// Tambahkan rute lainnya sesuai kebutuhan
// Admin route
$routes->get('admin/konfirmasiPembayaran/(:num)', 'Transaksi::confirmPayment/$1');
$routes->post('transaksi/processConfirmPayment/(:num)', 'Transaksi::processConfirmPayment/$1');

// User route
$routes->get('transaksi/payment/(:num)', 'Transaksi::confirmPayment/$1');
$routes->get('Etalase/getCity', 'Etalase::getCity');
$routes->get('Etalase/getCost', 'Etalase::getCost');
$routes->get('transaksi/invoice/(:num)', 'Transaksi::invoice/$1');
$routes->get('transaksi/view/(:num)', 'Transaksi::view/$1');
$routes->get('transaksi', 'Transaksi::index');
$routes->post('transaksi/confirmPayment/(:num)', 'Transaksi::confirmpayment/$1');
$routes->get('report', 'report::index');
$routes->get('report/exportTransaksis', 'Report::exportTransaksis');
$routes->get('/user', 'User::index');
$routes->get('/user/edit/(:num)', 'User::edit/$1');
$routes->post('/user/update/(:num)', 'User::update/$1');
$routes->get('/user/delete/(:num)', 'User::delete/$1');
$routes->get('/user/export', 'User::export');
$routes->get('barang/export', 'Barang::export');
$routes->get('pesanan', 'Pesanan::index');
$routes->get('pesanan/detail/(:num)', 'Pesanan::detail/$1');
$routes->get('profile', 'Profile::index');
$routes->get('profile/edit', 'Profile::edit');
$routes->get('pesanan/saya', 'Pesanan::index'); // Menampilkan riwayat pesanan
$routes->group('api', ['namespace' => 'App\Controllers', 'filter' => 'cors'], function($routes) {
    // Define your API routes here
	
});



/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}