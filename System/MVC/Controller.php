<?php
namespace MVC;

/**
 * Class Controller, a port of MVC
 *
 *
 * @package MVC
 */
class Controller
{

    /**
     * Request Class.
     */
    public $request;

    /**
     * Response Class.
     */
    public $response;

    /**
     * Middlewares
     */
    protected $middlewares = [];

    /**
     *  Construct
     */
    public function __construct()
    {
        $this->request = $GLOBALS['request'];
        $this->response = $GLOBALS['response'];
    }

    /**
     *  Register middleware
     */
    protected function registerMiddleware($middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * Return all the registered middlewares
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    /**
     * get Model
     * 
     * @param string $model
     * 
     * @return object
     */
    public function model($model)
    {
        $file = MODELS . ucfirst($model) . '.php';

        // check exists file
        if (file_exists($file)) {
            require_once $file;

            $model = 'Models' . str_replace('/', '', ucwords($model, '/'));
            // check class exists
            if (class_exists($model))
                return new $model;
            else
                throw new \Exception(sprintf('{ %s } this model class not found', $model));
        } else {
            throw new \Exception(sprintf('{ %s } this model file not found', $file));
        }
    }

    // send response faster
    public function send($status = 200, $msg)
    {
        $this->response->setHeader(sprintf('HTTP/1.1 ' . $status . ' %s', $this->response->getStatusCodeText($status)));
        $this->response->setContent($msg);
    }
}