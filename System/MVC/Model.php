<?php

namespace MVC;

/**
 * Class Model, a port of MVC
 *
 *
 * @package MVC
 */
class Model
{

    /**
     * @var
     */
    public $db;

    /**
     *  Construct
     */
    public function __construct()
    {
        $this->db = new \Database\DatabaseAdapter(
            DATABASE['Driver'],
            DATABASE['Host'],
            DATABASE['User'],
            DATABASE['Pass'],
            DATABASE['Name'],
            DATABASE['Port']
        );
    }
}