<?php

declare(strict_types=1);

use DI\Container;
use MongoDB\Client;
use MongoDB\Exception\Exception;

return function (Container $container) {
    $container->set('connection', function () use ($container) {
        $connection = $container->get('settings')['connection'];

        $host = $connection['host'];
        $dbname = $connection['dbname'];
        $dbuser = $connection['dbuser'];
        $dbpass = $connection['dbpass'];

        $server = "mongodb://$host/";

        try {
            $connection = new Client($server,[
                "authMechanism" => "SCRAM-SHA-1",
                "username" => $dbuser,
                "password" => $dbpass
            ]);

            $connection = $connection->selectDatabase($dbname);
        } catch (Exception $e) {
            echo 'Connection failed ' . $e->getMessage();
        }

        return $connection;
    });
};