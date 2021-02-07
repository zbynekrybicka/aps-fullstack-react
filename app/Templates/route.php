<?='<?php'; ?>

namespace App;

use FastRoute;
<?php
$services = [];
foreach ($routes as $route) {
    $services[$route->service->className] = true;
}
$services = array_keys($services);
foreach ($services as $service) { ?>
use App\Service\<?=ucfirst($service); ?>Service;
<?php } ?>

function route($method, $url, $headers, $data) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Content-type, Authorization');
    header('Access-Control-Allow-Methods: POST, PUT, GET, OPTIONS');
    $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
<?php foreach ($services as $service) { ?>
        $<?=$service; ?>Service = <?=ucfirst($service); ?>Service::get();
<?php } ?>
<?php foreach ($routes as $route) { ?>
        $r->addRoute(
            '<?=strtoupper($route->method); ?>', 
            '<?=$route->url; ?>', 
            [ $<?=$route->service->className; ?>Service, '<?=$route->service->method; ?>']
        );
<?php } ?>
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