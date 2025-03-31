<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/uploaded', 'PhotoController::uploaded', ['as' => 'uploaded', 'filter' => 'auth']);
