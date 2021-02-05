<?php
namespace App;
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/route.php';

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);
$headers = apache_request_headers();

if (in_array(strtoupper($httpMethod), ['POST', 'PUT'])) {
    $data = json_decode(file_get_contents('php://input'));
} else if (strtoupper($httpMethod) == 'GET') {
    $data = (object) $_GET;
} else {
    $data = (object) [];
}

route($httpMethod, $uri, $headers, $data);