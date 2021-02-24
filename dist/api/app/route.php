<?php
namespace App;

use FastRoute;
use App\Service\UserAuthService;

function route($method, $url, $headers, $data) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Content-type, Authorization');
    header('Access-Control-Allow-Methods: POST, PUT, GET, OPTIONS');
    $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
        $userAuthService = UserAuthService::get();
        $r->addRoute(
            'POST', 
            '/login', 
            [ $userAuthService, 'postLogin']
        );
    });
    $routeInfo = $dispatcher->dispatch($method, $url);
    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            http_response_code(404);
            break;
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            if (strtoupper($method) !== 'OPTIONS') {
                $allowedMethods = $routeInfo[1];
                echo json_encode($allowedMethods);
                http_response_code(405);
            }
            break;
        case FastRoute\Dispatcher::FOUND:
            $request = new Request($headers, $routeInfo[2], $data);
            /** @var Response $response */
            $response = $routeInfo[1]($request);
            http_response_code($response->code());
            header('Content-type: Application/json');
            if ($response->code() !== 204) {
                echo json_encode($response->data());
            }
            break;
    }
}