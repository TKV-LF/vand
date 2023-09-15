<?php

use MVC\Controller;

class ControllersStore extends Controller
{

    public function __construct()
    {
        parent::__construct();
        require_once MIDDLEWARES . 'AuthMiddleware.php';
        $this->registerMiddleware(new AuthMiddleware(['list', 'detail', 'create', 'update', 'delete']));
    }

    public function list()
    {

        // Connect to database
        $model = $this->model('store');

        // Read All Task
        $response = $model->getAllStore();

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

    public function paginateList()
    {
        // Connect to database
        $model = $this->model('store');
        // Read All Task
        $response = $model->getPaginateStore($this->request->get('limit'), $this->request->get('page'));

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

    public function detail($params)
    {
        if ($this->request->getMethod() == "GET") {
            // Connect to database
            $model = $this->model('store');

            $id = $params['id'] ?? 0;
            // Read All Task
            $response = $model->getStore($id);

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


    public function create()
    {
        if ($this->request->getMethod() === "POST") {
            // Connect to database
            $model = $this->model('store');

            // Read All Task
            $response = $model->createStore($this->request->getPost(), $this->request->getUser());

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

    public function update($params)
    {
        if ($this->request->getMethod() === "PUT") {
            // Connect to database
            $model = $this->model('store');

            $id = $params['id'] ?? 0;
            // Read All Task
            $response = $model->updateStore($this->request->getPut(), $id);

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

    public function delete($params)
    {
        if ($this->request->getMethod() === "DELETE") {
            // Connect to database
            $model = $this->model('store');

            $storeId = $params['id'] ?? 0;

            // Read All Task
            $response = $model->deleteStore($storeId);

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