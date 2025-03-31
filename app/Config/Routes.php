<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/publications', 'PublicationController::index');
$routes->get('/fetchPublications', 'PublicationController::fetchPublications');