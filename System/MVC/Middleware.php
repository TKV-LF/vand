<?php
namespace MVC;

abstract class Middleware
{
    /**
     * Router controller current action
     */
    protected $actions = [];

    protected $request;

    protected $response;


    public function __construct($actions = [])
    {
        $this->actions = $actions;
        $this->request = $GLOBALS['request'];
        $this->response = $GLOBALS['response'];
    }

    /**
     * Return all actions
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Execute middleware
     */
    abstract public function execute($action);

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
}