<?php
use MVC\Controller;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="My First API", version="0.1")
 */
class OpenApi
{
}

class ControllersProduct extends Controller
{

    public function __construct()
    {
        parent::__construct();
        require_once MIDDLEWARES . 'AuthMiddleware.php';
        $this->registerMiddleware(new AuthMiddleware(['list', 'detail', 'create', 'update', 'delete']));
    }

    /**
     * @OA\Get(
     *     path="/product",
     *     @OA\Response(response="200", description="An example resource")
     * )
     */
    public function list()
    {

        // Connect to database
        $model = $this->model('product');

        // Read All Task
        $response = $model->getAllProduct();

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

    /**
     * @OA\Get(
     *     path="/product/list",
     *     @OA\Response(response="200", description="An example resource")
     * )
     */
    public function paginateList()
    {
        $limit = $this->request->get('limit');
        $page = $this->request->get('page');

        // Connect to database
        $model = $this->model('product');

        // Read All Task
        $response = $model->getPaginateProduct($limit, $page);

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

    /**
     * @OA\Post(
     *     path="/product/search",
     *     @OA\Response(response="200", description="An example resource")
     * )
     */
    public function search()
    {
        if ($this->request->getMethod() === "POST") {
            $limit = $this->request->get('limit');
            $page = $this->request->get('page');

            // Connect to database
            $model = $this->model('product');

            // Read All Task
            $response = $model->searchProduct($this->request->getPost(), $limit, $page);

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

    /**
     * @OA\Get(
     *     path="/product/{id}",
     *     @OA\Response(response="200", description="An example resource")
     * )
     */
    public function detail($params)
    {
        // Connect to database
        $model = $this->model('product');

        $id = $params['id'] ?? 0;
        // Read All Task
        $response = $model->getProduct($id);

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

    /**
     * @OA\Post(
     *     path="/product/create",
     *     @OA\Response(response="200", description="An example resource")
     * )
     */
    public function create()
    {
        // Connect to database
        $model = $this->model('product');

        // Read All Task
        $response = $model->createProduct($this->request->getPost(), $this->request->getUser());

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

    /**
     * @OA\Put(
     *     path="/product/update/{id}",
     *     @OA\Response(response="200", description="An example resource")
     * )
     */
    public function update($params)
    {
        if ($this->request->getMethod() === "PUT") {
            $model = $this->model('product');

            $id = $params['id'] ?? 0;
            // Read All Task
            $response = $model->updateProduct($this->request->getPut(), $id);

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

    /**
     * @OA\Delete(
     *     path="/product/delete/{id}",
     *     @OA\Response(response="200", description="An example resource")
     * )
     */
    public function delete($params)
    {
        $model = $this->model('product');

        $id = $params['id'] ?? 0;
        // Read All Task
        $response = $model->deleteProduct($id, $this->request->getUser());

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