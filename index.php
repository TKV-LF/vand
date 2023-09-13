<?php
// load config
require 'config.php';
require SYSTEM . 'Startup.php';

use Router\Router;

$request = new Http\Request();
$response = new Http\Response();

$response->setHeader('Access-Control-Allow-Origin: *');
$response->setHeader("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
$response->setHeader('Content-Type: application/json; charset=UTF-8');

// set request url and method
$router = new Router($request->getUrl(), $request->getMethod());

require 'Router/Router.php';

$router->run();

$response->render();
