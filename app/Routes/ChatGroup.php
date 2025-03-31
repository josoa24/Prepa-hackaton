<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/chats', 'ChatGroupController::index', ['as'  => 'chat_groups', 'filter' => 'auth']);

$routes->get('/chats/(:any)', 'ChatGroupController::list/$1', ['as' => 'chat', 'filter' => 'auth']);
