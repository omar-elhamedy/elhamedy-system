<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->get('/', 'Home::index');
$routes->get('currency', 'Home::currency');

$routes->post('/bookmark/add', 'Home::addBookmark');
$routes->post('/bookmark/remove', 'Home::removeBookmark');
/*
 * --------------------------------------------------------------------
 * Storage Definitions
 * --------------------------------------------------------------------
 */

/* GET */
$routes->get('/storage', 'Storage::index');
$routes->get('/storage/view/(:num)', 'Storage::view/$1');
$routes->get('/storage/products/(:num)', 'Storage::product/$1');


$routes->post('/storage/view/export/(:num)', 'Storage::export/$1');
$routes->post('/storage/remove-item/(:num)', 'Storage::remove/$1');
$routes->post('/storage/add-item/(:num)', 'Storage::add/$1');

/*
 * --------------------------------------------------------------------
 * Accounts Definitions
 * --------------------------------------------------------------------
 */

$routes->get('/accounts/(:num)', 'Accounts::index/$1');

$routes->post('/accounts/(:num)/add', 'Accounts::add/$1');
$routes->post('/accounts/(:num)/withdraw', 'Accounts::withdraw/$1');
/*
 * --------------------------------------------------------------------
 * Supplier Definitions
 * --------------------------------------------------------------------
 */

/* GET */
$routes->get('/suppliers', 'Supplier::index');
$routes->get('/suppliers/new', 'Supplier::new');
$routes->get('/suppliers/(:num)', 'Supplier::view/$1');
$routes->get('/suppliers/search', 'Supplier::search');
$routes->get('/suppliers/(:num)/supply-items', 'Supplier::newSupply/$1');
$routes->get('/suppliers/remove-item/(:num)/(:any)', 'Supplier::removeItemFromCart/$1/$2');
$routes->get('/suppliers/(:num)/records', 'Supplier::recordsList/$1');
$routes->get('/suppliers/(:num)/payments', 'Supplier::payments/$1');
$routes->get('/suppliers/(:num)/record/(:num)', 'Supplier::recordsView/$1/$2');
$routes->get('/suppliers/edit/(:num)', 'Supplier::edit/$1');
$routes->get('/suppliers/remove/(:num)', 'Supplier::remove/$1');

/* POST */
$routes->post('/suppliers/new/add', 'Supplier::add');
$routes->post('/suppliers/update/(:num)', 'Supplier::updateSupplier/$1');

$routes->post('/suppliers/supply', 'Supplier::supply');
$routes->post('/suppliers/show', 'Supplier::show');
$routes->post('/suppliers/pay', 'Supplier::pay');
$routes->post('/suppliers/prices/update', 'Supplier::update');
$routes->post('/suppliers/add-to-cart', 'Supplier::addCart');
$routes->post('/suppliers/submit-new-supply/(:num)', 'Supplier::submitSupply/$1');


/*
 * --------------------------------------------------------------------
 * User Definitions
 * --------------------------------------------------------------------
 */

$routes->get('/signup', 'Signup::new');
$routes->get('/login', 'Login::new');
$routes->get('/logout', 'Login::delete');
$routes->get('/logout/confirm', 'Login::showLogoutMessage');
$routes->post('/signup/create', 'Signup::create');
$routes->post('/login/create', 'Login::create');
$routes->get('/profile/edit', 'User::edit');
$routes->post('/profile/update/(:num)', 'User::update/$1');
/*
 * --------------------------------------------------------------------
 * Client Definitions
 * --------------------------------------------------------------------
 */


/* GET */
$routes->get('/clients', 'Client::index');
$routes->get('/clients/new', 'Client::new');
$routes->get('/clients/search' , 'Client::search');
$routes->get('/clients/(:num)' , 'Client::show/$1');
$routes->get('/clients/edit/(:num)', 'Client::edit/$1');

/* POST */
$routes->post('/clients/add', 'Client::create');
$routes->post('/clients/pay', 'Client::paid');
$routes->post('/clients/new/add', 'Client::addClient');
$routes->post('/clients/show', 'Client::getClientByName');
$routes->post('/clients/update/(:num)', 'Client::update/$1');

$routes->get('/reports', 'Report::index');
$routes->get('/settings', 'Settings::index');

/*
 * --------------------------------------------------------------------
 * Api Definitions
 * --------------------------------------------------------------------
 */

$routes->get('/api/products/all', 'Api::index');
$routes->get('/api/products/top', 'Api::getTopProducts');


/*
 * --------------------------------------------------------------------
 * Inventory Definitions
 * --------------------------------------------------------------------
 */

/* GET */
$routes->get('/inv', 'Inventory::index');

$routes->add('/inv/delete/(:num)', 'Inventory::delete/$1');
$routes->get('/inv/edit/(:num)', 'Inventory::edit/$1');
$routes->post('/inv/update/(:num)', 'Inventory::update/$1');

/*
 * --------------------------------------------------------------------
 * Settings Definitions
 * --------------------------------------------------------------------
 */

/* GET */
$routes->get('/settings', 'Settings::index');
$routes->get('/settings/product', 'Settings::product');
$routes->get('/settings/product/new', 'Settings::newProduct');
$routes->get('/settings/product/color', 'Settings::color');
$routes->add('/settings/product/color/edit/(:num)', 'Settings::editColor/$1');
$routes->get('/settings/product/type', 'Settings::type');
$routes->add('/settings/product/type/edit/(:num)', 'Settings::editType/$1');
$routes->get('/settings/product/material', 'Settings::material');
$routes->add('/settings/product/material/edit/(:num)', 'Settings::editMaterial/$1');
$routes->get('/settings/product/size', 'Settings::size');
$routes->add('/settings/product/size/edit/(:num)', 'Settings::editSize/$1');
$routes->get('/settings/product/size-collection', 'Settings::sizeCollection');
$routes->add('/settings/product/size-collection/edit/(:num)', 'Settings::editSizeCollection/$1');
$routes->get('/settings/product/brand', 'Settings::brand');
$routes->add('/settings/product/brand/edit/(:num)', 'Settings::editBrand/$1');
$routes->get('/settings/product/unit', 'Settings::unit');
$routes->add('/settings/product/unit/edit/(:num)', 'Settings::editUnit/$1');
$routes->get('/settings/product/storage', 'Settings::storage');
$routes->add('/settings/product/storage/edit/(:num)', 'Settings::editStorage/$1');
$routes->get('/settings/payment', 'Settings::payment');
$routes->add('/settings/payment/edit/(:num)', 'Settings::editPayment/$1');


/* POST */
$routes->post('settings/payment/new', 'Settings::addPayment');
$routes->post('settings/payment/delete/(:num)', 'Settings::removePayment/$1');
$routes->post('settings/payment/update/(:num)', 'Settings::updatePayment/$1');

$routes->post('/settings/product/color/new', 'Settings::addColor');
$routes->post('/settings/product/color/delete/(:num)', 'Settings::removeColor/$1');
$routes->post('/settings/product/color/update/(:num)', 'Settings::updateColor/$1');

$routes->post('/settings/product/type/new', 'Settings::addType');
$routes->post('/settings/product/type/delete/(:num)', 'Settings::removeType/$1');
$routes->post('/settings/product/type/update/(:num)', 'Settings::updateType/$1');

$routes->post('/settings/product/material/new', 'Settings::addMaterial');
$routes->post('/settings/product/material/delete/(:num)', 'Settings::removeMaterial/$1');
$routes->post('/settings/product/material/update/(:num)', 'Settings::updateMaterial/$1');

$routes->post('/settings/product/size/new', 'Settings::addSize');
$routes->post('/settings/product/size/delete/(:num)', 'Settings::removeSize/$1');
$routes->post('/settings/product/size/update/(:num)', 'Settings::updateSize/$1');

$routes->post('/settings/product/size-collection/new/', 'Settings::addSizeCollection');
$routes->post('/settings/product/size-collection/delete/(:num)', 'Settings::removeSizeCollection/$1');
$routes->post('/settings/product/size-collection/update/(:num)', 'Settings::updateSizeCollection/$1');


$routes->post('/settings/product/brand/new', 'Settings::addBrand');
$routes->post('/settings/product/brand/delete/(:num)', 'Settings::removeBrand/$1');
$routes->post('/settings/product/brand/update/(:num)', 'Settings::updateBrand/$1');

$routes->post('/settings/product/unit/new', 'Settings::addUnit');
$routes->post('/settings/product/unit/delete/(:num)', 'Settings::removeUnit/$1');
$routes->post('/settings/product/unit/update/(:num)', 'Settings::updateUnit/$1');

$routes->post('/settings/product/new/create', 'Products::createProduct');

$routes->post('/settings/product/storage/new', 'Settings::createStorage');
$routes->post('/settings/product/storage/delete/(:num)', 'Settings::removeStorage/$1');
$routes->post('/settings/product/storage/update/(:num)', 'Settings::updateStorage/$1');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
