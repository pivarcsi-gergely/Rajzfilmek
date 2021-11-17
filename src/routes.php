<?php

use Petrik\Rajzfilmek\Rajzfilm;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function(Slim\App $app) {
    $app->get('/rajzfilmek', function(Request $request, Response $response){
        $rajzfilmek = Rajzfilm::osszes();
        $kimenet = json_encode($rajzfilmek);
        $response->withHeader('Content-type', 'application/json')->getBody()->write($kimenet);
        return $response;
    });
};