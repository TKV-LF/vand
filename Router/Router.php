<?php
$router->get('/documentation', function () {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/vand-api/Documentation/index.php';
});

$router->get('/documentation.json', function () {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/vand-api/Documentation/documentation.php';
});

// User
$router->post('/user/create', 'user@create');

$router->get('/user/detail', 'user@detail');

// Auth
$router->post('/auth/login', 'auth@login');

$router->get('/auth/refresh', 'auth@refresh');

// Store
$router->get('/store', 'store@list');

$router->get('/store/list', 'store@list');

$router->get('/store/paginate', 'store@paginateList');

$router->post('/store/search', 'store@search');

$router->post('/store/create', 'store@create');

$router->get('/store/:id', 'store@detail');

$router->put('/store/update/:id', 'store@update');

$router->delete('/store/delete/:id', 'store@delete');

// Product

$router->get('/product', 'product@list');

$router->get('/product/list', 'product@list');

$router->get('/product/paginate', 'product@paginateList');

$router->post('/product/search', 'product@search');

$router->post('/product/create', 'product@create');

$router->get('/product/:id', 'product@detail');

$router->put('/product/update/:id', 'product@update');

$router->delete('/product/delete/:id', 'product@delete');