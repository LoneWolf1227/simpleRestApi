<?php

namespace App\Controller;

use App\Model\Users;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AddUserController extends Controller
{
    public function __construct(private Users $users)
    { }

    public function add(Request $request, Response $response): Response
    {
        $params = $request->getParsedBody();
        $data = $this->users->add($params);

        return $this->responseJsonData($data,$response);
    }
}