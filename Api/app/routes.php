<?php
declare(strict_types=1);

use App\Controller\AddUserController;
use App\Controller\ViewUsersController;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

    $app->group('/users', function (Group $group) {
        $group->get('', [ViewUsersController::class, 'users']);
        $group->get('/{id}', [ViewUsersController::class, 'getUserById']);
        $group->get('/phone/{phone}', [ViewUsersController::class, 'getUserByPhone']);
        $group->post('/add', [AddUserController::class, 'add']);
    });

};