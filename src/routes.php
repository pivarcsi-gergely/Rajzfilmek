<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function(Slim\App $app) {
    $app->get('/rajzfilmek', function(Request $request, Response $response){
    $response->getBody()->write('Nothing here. Yet...');
    return $response;
    });
};