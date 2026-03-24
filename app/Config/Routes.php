<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('auth/check', 'Auth::check');
$routes->get('logout', 'Auth::logout');

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('dashboard', 'Dashboard::index');

    $routes->group('transactions', function ($routes) {
        $routes->get('/', 'Transactions::index');
        $routes->get('create', 'Transactions::create');
        $routes->get('get-stock/(:num)', 'Transactions::getProductStock/$1');
        $routes->post('store', 'Transactions::store');
    });

    $routes->get('products', 'Products::index');
    $routes->get('products/search', 'Products::search');
    $routes->get('categories', 'Categories::index');

    $routes->get('reports/critical', 'Reports::criticalStock');
    $routes->get('reports/export-pdf', 'Reports::exportPdf');

    $routes->group('', ['filter' => 'admin'], function ($routes) {

        $routes->group('products', function ($routes) {
            $routes->get('new', 'Products::new');
            $routes->post('store', 'Products::store');
            $routes->get('edit/(:num)', 'Products::edit/$1');
            $routes->post('update/(:num)', 'Products::update/$1');
            $routes->post('delete/(:num)', 'Products::delete/$1');
        });

        $routes->group('categories', function ($routes) {
            $routes->get('create', 'Categories::create');
            $routes->post('store', 'Categories::store');
            $routes->get('edit/(:num)', 'Categories::edit/$1');
            $routes->post('update/(:num)', 'Categories::update/$1');
            $routes->post('delete/(:num)', 'Categories::delete/$1');
            $routes->post('check-name', 'Categories::checkName');
        });

        $routes->group('users', function ($routes) {
            $routes->get('/', 'Users::index');
            $routes->get('create', 'Users::create');
            $routes->post('store', 'Users::store');
            $routes->get('edit/(:num)', 'Users::edit/$1');
            $routes->post('update/(:num)', 'Users::update/$1');
            $routes->post('delete/(:num)', 'Users::delete/$1');
            $routes->post('restore/(:num)', 'Users::restore/$1');
        });
    });
});
