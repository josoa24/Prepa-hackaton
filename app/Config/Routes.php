<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'UserController::login', ['as' => 'login']);
$routes->get('/logout', 'UserController::logout', ['as' => 'logout']);
$routes->post('/logout', 'UserController::logout', ['as' => 'logout']);;
$routes->post('/validate_login', 'UserController::validate_login');
$routes->get('/home', 'UserController::home', ['filter' => 'auth']);
$routes->get('/fetchPublications', 'PublicationController::fetchPublications', ['filter' => 'auth']);
$routes->get('/participate', 'ColaborationController::participate', ['filter' => 'auth']);
$routes->post('/storePublication', 'PublicationController::storePublication', ['filter' => 'auth']);
$routes->get('/sendMail', 'EmailController::sendEmail', ['filter' => 'auth']);
$routes->get('/search', 'PublicationController::search', ['filter' => 'auth']);
$routes->get('/fetchPublicationsByUser', 'PublicationController::fetchPublicationsByUser', ['filter' => 'auth']);  
$routes->get('/fetchPublicationBysUserSearch', 'PublicationController::getUserPublicationSearch', ['filter' => 'auth']);
$routes->get('/user/publication','UserController::publication', ['filter' => 'auth']);