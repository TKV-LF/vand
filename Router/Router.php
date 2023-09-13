<?php
$router->get('/home', 'home@index');

$router->get('/home index', 'home@index');

$router->post('/home', 'home@post');

// User
$router->get('/user', 'user@index');

$router->post('/user', 'user@post');

$router->post('/user/create', 'user@create');

$router->get('/user/{id}', 'user@show');

$router->put('/user/{id}', 'user@update');

$router->delete('/user/{id}', 'user@delete');

// Auth
$router->post('/auth/login', 'auth@login');



$router->get('/', function () {
    echo 'Welcome ';
});