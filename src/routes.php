<?php

use Petrik\Rajzfilmek\Rajzfilm;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function(Slim\App $app) {
    $app->get('/rajzfilmek', function(Request $request, Response $response){
        $rajzfilmek = Rajzfilm::osszes();
        $kimenet = json_encode($rajzfilmek);
        return $response->withHeader('Content-type', 'application/json')->getBody()->write($kimenet);
    });

    $app->post('/rajzfilmek',function(Request $request, Response $response){
        $input = json_decode($request->getBody(), true);
        // Bemenet validáció. egy másik órán... :(
        $rajzfilm = new Rajzfilm();
        $rajzfilm->setAttributes($input);
        $rajzfilm->uj();

        $kimenet = json_encode($rajzfilm);
        return $response
        ->withStatus(201)
        ->withHeader('Content-type', 'application/json')
        ->getBody()->write($kimenet);
    });
};