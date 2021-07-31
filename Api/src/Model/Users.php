<?php

namespace App\Model;

use App\Services\ValidatorService;
use MongoDB\BSON\ObjectId;
use MongoDB\Driver\Exception\InvalidArgumentException;
use Psr\Container\ContainerInterface;

class Users
{
    private $collection;

    private const ROLES = [0 => 'user', 1 => 'admin', 2 => 'superAdmin'];

    public function __construct(ContainerInterface $container, private ValidatorService $validator)
    {
        $this->collection = $container->get('connection')->selectCollection('users');
    }

    public function add($params): array
    {
        if (!empty($params['firstName']) && $this->validator->alpha($params['firstName']) &&
            !empty($params['lastName']) && $this->validator->alpha($params['lastName']) &&
            !empty($params['phone']) && $this->validator->digit($params['phone'])
        ) {
            $user = [
                'firstName' => $params['firstName'],
                'lastName' => $params['lastName'],
                'phone' => (int)$params['phone'],
                'role' => 0
            ];
            $result = $this->collection->insertOne($user);

            return ['_id' => $result->getInsertedId(),'message' => 'User created', 'status' => 'Ok'];
        }
        return ['message' => 'Invalid data sent', 'status' => 'Error'];
    }

    public function list(): array
    {
        $users = $this->collection->find()->toArray();

        if (empty($users)) {
            return ['message' => 'Empty user table', 'status' => 'Ok'];
        }

        return $users;
    }

    public function getByArg($name, $data)
    {
        if ($name === '_id') {
            try {
                $data = new ObjectId($data);
            } catch (InvalidArgumentException $e) {
                return ['message' => $e->getMessage(), 'status' => 'Error'];
            }
        }

        $findOne = $this->collection->findOne([$name => $data]);

        if (empty($findOne)) {
            return ['message' => 'User not founded', 'status' => 'Ok'];
        }

        $findOne['role'] = self::ROLES[$findOne['role']];

        return $findOne;
    }
}
