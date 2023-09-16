<?php
use MVC\Controller;


class ControllersAuth extends Controller
{
    public function login()
    {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('auth');

            // Read All Task
            $response = $model->login($this->request->getPost());

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

    public function refresh()
    {
        if ($this->request->getMethod() == "GET") {
            // Connect to database
            $model = $this->model('auth');

            // Read All Task
            $response = $model->refresh($this->request->get('refresh_token'));

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