<?php

declare(strict_types=1);

use DI\Container;
use DI\Bridge\Slim\Bridge as AppFactory;

$container = new Container();

$settings = require __DIR__ .'/settings.php';
$settings($container);

$connection = require __DIR__ . '/connection.php';
$connection($container);

$logger = require __DIR__ . '/logger.php';
$logger($container);

$app = AppFactory::create($container);

$middleware = require __DIR__ . '/middleware.php';
$middleware($app);

$routes = require __DIR__ . '/routes.php';
$routes($app);

$app->run();