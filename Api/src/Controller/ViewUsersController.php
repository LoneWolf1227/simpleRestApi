<?php

namespace App\Controller;

use App\Model\Users;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ViewUsersController extends Controller
{
    public function __construct(private Users $users)
    { }

    public function getUserById(Response $response, $id): Response
    {
        $user = $this->users->getByArg('_id', $id);
        return $this->responseJsonData($user, $response);
    }

    public function getUserByPhone(Response $response, $phone): Response
    {
        $user = $this->users->getByArg('phone', $phone);
        return $this->responseJsonData($user, $response);
    }

}