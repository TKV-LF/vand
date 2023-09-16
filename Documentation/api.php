<?php
require("../vendor/autoload.php");

$openapi = \OpenApi\Generator::scan([$_SERVER['DOCUMENT_ROOT'] . '/vand-api/Application/Controllers/Product.php']);

header('Content-Type: application/x-yaml');
echo $openapi->toJson();