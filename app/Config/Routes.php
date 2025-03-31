<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'UserController::login', ['as' => 'login']);
$routes->post('/validate_login', 'UserController::validate_login');
$routes->get('/home', 'UserController::home', ['as' => 'home', 'filter' => 'auth']);
