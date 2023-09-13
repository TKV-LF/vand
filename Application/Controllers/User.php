<?php

use MVC\Controller;

class ControllersUser extends Controller
{

    public function index()
    {

        // Connect to database
        $model = $this->model('user');

        // Read All Task
        $users = $model->getAllUser();

        // Prepare Data
        $data = ['data' => $users];

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data);
    }

    public function post()
    {

        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('user');

            // Read All Task
            $users = $model->getAllUser();

            // Prepare Data
            $data = ['data' => $users];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }

    public function create()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('user');

            // Read All Task
            $users = $model->createUser($this->request->getPost());

            // Prepare Data
            $data = ['data' => $users];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }


}