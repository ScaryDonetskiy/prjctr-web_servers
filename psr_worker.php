<?php

use App\Controller;
use League\Route\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\RoadRunner;
use Nyholm\Psr7;

include "vendor/autoload.php";

$worker = RoadRunner\Worker::create();
$psrFactory = new Psr7\Factory\Psr17Factory();

$psr7 = new RoadRunner\Http\PSR7Worker($worker, $psrFactory, $psrFactory, $psrFactory);

$router = new Router();

$router->get('/health', function (): ResponseInterface {
    return new Psr7\Response(body: 'ok');
});

while (true) {
    try {
        $request = $psr7->waitRequest();

        if (!($request instanceof ServerRequestInterface)) { // Termination request received
            break;
        }
    } catch (\Throwable) {
        $psr7->respond(new Psr7\Response(400)); // Bad Request
        continue;
    }

    try {
        $psr7->respond($router->dispatch($request));
    } catch (\Throwable $exception) {
        $psr7->respond(new Psr7\Response(500, [], 'Something Went Wrong! Message: ' . $exception->getMessage()));
    }
}
