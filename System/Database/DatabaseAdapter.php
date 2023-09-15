<?php
namespace Database;

/**
 * Class DatabaseAdapter for handel database query
 *
 *
 * @package Database
 */
class DatabaseAdapter
{

    /**
     *  Database Connection
     *
     * @var
     */
    private $dbConnection;

    /**
     * Database constructor. set connection driver [pdo, mysqli, mysql,...]
     *
     * @param $driver
     * @param $hostname
     * @param $username
     * @param $password
     * @param $database
     */
    public function __construct($driver, $hostname, $username, $password, $database, $port)
    {
        $class = '\Database\DB\\' . $driver;

        if (class_exists($class)) {
            $this->dbConnection = new $class($hostname, $username, $password, $database, $port);
        } else {
            exit('Error: Could not load database driver ' . $driver . '!');
        }
    }

    /**
     * @param $sql
     * @return mixed
     */
    public function query($sql)
    {
        return $this->dbConnection->query($sql);
    }

    public function insert($data, $tableName, $attributes)
    {
        return $this->dbConnection->insert($data, $tableName, $attributes);
    }

    /**
     * @param $data, $tableName, $attributes
     * @return mixed
     */
    public function update($data, $tableName, $attributes, $where)
    {
        return $this->dbConnection->update($data, $tableName, $attributes, $where);
    }

    /**
     * @param $data, $tableName, $attributes
     * @return mixed
     */
    public function delete($data, $tableName, $attributes)
    {
        return $this->dbConnection->delete($data, $tableName, $attributes);
    }


    /**
     * @param $value
     * @return mixed
     */
    public function escape($value)
    {
        return $this->dbConnection->escape($value);
    }

    /**
     * @return mixed
     */
    public function getLastId()
    {
        return $this->dbConnection->getLastId();
    }

    /**
     * @return mixed
     */
    public function find($tableName, $choice = "*", $orderBy = "id desc")
    {
        return $this->dbConnection->find($tableName, $choice, $orderBy);
    }

    /**
     * @return mixed
     */
    public function paginate($tableName, $limit = 10, $offset = 0, $choice = "*", $orderBy = "id desc")
    {
        return $this->dbConnection->paginate($tableName, $limit, $offset, $choice, $orderBy);
    }

    /**
     * @return mixed
     */
    public function findOne($tableName, $where, $choice = "*", $orderBy = "id desc")
    {
        return $this->dbConnection->findOne($tableName, $where, $choice, $orderBy);
    }

    public function beginTransaction()
    {
        return $this->dbConnection->beginTransaction();
    }

    public function commit()
    {
        return $this->dbConnection->commit();
    }

    public function rollBack()
    {
        return $this->dbConnection->rollBack();
    }

}