<?php
require("../vendor/autoload.php");

$openapi = \OpenApi\Generator::scan([$_SERVER['DOCUMENT_ROOT'] . '/Application/Controllers']);

header('Content-Type: application/x-yaml');
echo $openapi->toJson();