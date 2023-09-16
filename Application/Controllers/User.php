<?php

use MVC\Controller;

class ControllersUser extends Controller
{

    public function create()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('user');

            // Read All Task
            $response = $model->createUser($this->request->getPost());

            if (!$response || is_string($response)) {
                $this->response->sendStatus(200);
                $this->response->setContent([
                    'code' => '400',
                    'error' => $response
                ]);
                return;
            }

            // Prepare Data
            $data = [
                'code' => '200',
                'data' => $response
            ];
            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }


}