<?php
use App\Router;

/**
 * Web routes
 */

Router::get('/', 'Controllers\HomeController@index');
Router::get('/todo', 'Controllers\TodoController@index');
Router::get('/todo/(:any)', 'Controllers\TodoController@show');
Router::get('/todo/create', 'Controllers\TodoController@create');
Router::post('/todo/create', 'Controllers\TodoController@store');
Router::get('/todo/update/(:any)', 'Controllers\TodoController@edit');
Router::post('/todo/update', 'Controllers\TodoController@update');
Router::delete('/todo/delete/(:any)', 'Controllers\TodoController@delete');

Router::get('/register', 'Controllers\AuthController@registerForm');
Router::post('/register', 'Controllers\AuthController@register');
Router::get('/login', 'Controllers\AuthController@loginForm');
Router::post('/login', 'Controllers\AuthController@login');
Router::get('/logout', 'Controllers\AuthController@logout');

/**
 * API routes
 */
Router::get('/api/v1/todo', 'Controllers\API\BlogController@index');
Router::get('/api/v1/todo/(:any)', 'Controllers\API\BlogController@show');
Router::post('/api/v1/todo/create', 'Controllers\API\BlogController@store');
Router::put('/api/v1/todo/update', 'Controllers\API\BlogController@update');
Router::delete('/api/v1/todo/delete/(:any)', 'Controllers\API\BlogController@delete');

/**
 * There is no route defined for a certain location
 */
Router::error(function () {
    die('404 Page not found');
});

/**
 * Uncomment this function to migrate tables
 * It will commented automatically again
 */
// createTables();

Router::dispatch();
