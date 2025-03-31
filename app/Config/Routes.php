<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'UserController::login');
$routes->post('validate_login', 'UserController::validate_login');
$routes->get('/home', 'UserController::home');
$routes->get('/fetchPublications', 'PublicationController::fetchPublications');
