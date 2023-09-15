<?php

use MVC\Middleware;

class AuthMiddleware extends Middleware
{
    public function __construct($actions = [])
    {
        parent::__construct($actions);
    }

    public function execute($action)
    {
        $token = $this->request->getBearerToken();

        if (!$token) {
            $this->response->sendStatus(200);
            $this->response->setContent([
                'code' => '400',
                'error' => 'Token is required'
            ]);
            $this->response->send();
        }

        $auth = $this->model('auth');
        $response = $auth->getUserByToken($token);
        if (!$response || is_string($response)) {
            $this->response->sendStatus(200);
            $this->response->setContent([
                'code' => '400',
                'error' => $response
            ]);
            $this->response->send();

        }

        $this->request->setUser($response->user);
    }
}