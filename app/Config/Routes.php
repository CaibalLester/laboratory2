<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/music', 'MusicController::CaibalLester');
$routes->get('/music/(:any)', 'MusicController::music/$1');
$routes->get('/search/(:any)', 'MusicController::search/$1');
$routes->post('/save', 'MusicController::save');
$routes->get('/delete/(:any)', 'MusicController::delete/$1');
$routes->get('/edit/(:any)', 'MusicController::edit/$1');
