<?php

use MVC\Controller;

class ControllersProduct extends Controller
{

    public function index()
    {

        // Connect to database
        $model = $this->model('product');

        // Read All Task
        $users = $model->getAllUser();

        // Prepare Data
        $data = ['data' => $users];

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data);
    }

}