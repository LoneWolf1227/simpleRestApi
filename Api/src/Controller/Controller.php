<?php


namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;

class Controller
{
    protected function responseJsonData($data, Response $response): Response
    {
        if (isset($data['status']) && $data['status'] === 'Error') {

            $response = $response->withStatus(400);

            $json = json_encode($data, JSON_PRETTY_PRINT);
            $response->getBody()->write($json);

            return $response->withHeader('Content-Type', 'application/json');
        }

        $json = json_encode($data, JSON_PRETTY_PRINT);
        $response->getBody()->write($json);

        return $response->withHeader('Content-Type', 'application/json');
    }
}