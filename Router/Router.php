<?php
$router->get('/home', 'home@index');



// User
$router->get('/user', 'user@index');

$router->post('/user/create', 'user@create');

// $router->get('/user/:id', 'user@show');

// $router->put('/user/:id', 'user@update');

// $router->delete('/user/:id', 'user@delete');

// Auth
$router->post('/auth/login', 'auth@login');

$router->get('/auth/refresh', 'auth@refresh');

// Store
$router->get('/store', 'store@list');

$router->get('/store/list', 'store@list');

$router->get('/store/paginate', 'store@paginateList');

$router->post('/store/create', 'store@create');

$router->get('/store/:id', 'store@detail');

$router->put('/store/update/:id', 'store@update');

$router->delete('/store/delete/:id', 'store@delete');

// Product

$router->get('/product', 'product@list');

$router->get('/product/list', 'product@list');

$router->get('/product/paginate', 'product@paginateList');

$router->post('/product/create', 'product@create');

$router->get('/product/:id', 'product@detail');

$router->put('/product/update/:id', 'product@update');

$router->delete('/product/delete/:id', 'product@delete');



$router->get('/', function () {
    echo 'Welcome ';
});