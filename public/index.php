<?php
require '../vendor/autoload.php';

use Slim\Factory\AppFactory;


$app = AppFactory::create();

$routes = require '../src/routes.php';
$routes($app);

$app->run();