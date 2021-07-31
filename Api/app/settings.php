<?php

declare(strict_types=1);

use DI\Container;
use Monolog\Logger;

return function (Container $container) {
    $container->set('settings', function () {
        return [
            'errorDisplay' => [
                'displayErrorDetails' => true,
                'logErrorDetails' => true,
                'logErrors' => true,
            ],
            'apiLogger' => [
                'name' => 'Api',
                'path' => $_ENV['LOGS_DIR_DOCKER'] . '/app.log',
                'level' => Logger::DEBUG
            ],
            'connection' => [
                'host' => $_ENV['host'],
                'dbname' => $_ENV['dbname'],
                'dbuser' => $_ENV['dbuser'],
                'dbpass' => $_ENV['dbpass']
            ]
        ];
    });
};