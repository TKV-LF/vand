<?php

use MVC\Controller;

class ControllersAuth extends Controller
{

    public function index()
    {
        echo "Auth";
    }

    public function login()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('auth');

            // Read All Task
            $response = $model->login($this->request->getPost());

            // Prepare Data
            $data = ['data' => $response];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }


}