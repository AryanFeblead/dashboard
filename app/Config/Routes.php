<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/addProduct', 'Product::index');
$routes->get('/viewProduct', 'Product::view_product');
$routes->post('/add_product', 'Product::add_product');
$routes->get('/view_product', 'Product::view_all_product');
$routes->get('/addCustomer', 'Customer::index');
$routes->get('/viewCustomer', 'Customer::view_customer');
$routes->get('/addOrder', 'Order::index');
$routes->get('/viewOrder', 'Order::view_order');
