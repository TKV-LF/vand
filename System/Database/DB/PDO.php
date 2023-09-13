<?php

namespace Database\DB;

/**
 *  Global Class PDO
 */
final class PDO
{

    /**
     * @var
     */
    private $pdo = null;

    /**
     * @var
     */
    private $statement = null;


    /**
     *  Construct, create opject of PDO class
     */
    public function __construct($hostname, $username, $password, $database, $port)
    {
        try {
            $this->pdo = new \PDO("mysql:host=" . $hostname . ";port=" . $port . ";dbname=" . $database, $username, $password, array(\PDO::ATTR_PERSISTENT => true));
        } catch (\PDOException $e) {
            trigger_error('Error: Could not make a database link ( ' . $e->getMessage() . '). Error Code : ' . $e->getCode() . ' <br />');
            exit();
        }

        // set default setting database
        $this->pdo->exec("SET NAMES 'utf8'");
        $this->pdo->exec("SET CHARACTER SET utf8");
        $this->pdo->exec("SET CHARACTER_SET_CONNECTION=utf8");
        $this->pdo->exec("SET SQL_MODE = ''");

    }

    /**
     * exec query statement
     */
    public function query($sql)
    {
        $this->statement = $this->prepare($sql);
        $result = false;

        try {
            if ($this->statement && $this->statement->execute()) {
                $data = array();

                while ($row = $this->statement->fetch(\PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }

                // create std class
                $result = new \stdClass();
                $result->row = (isset($data[0]) ? $data[0] : array());
                $result->rows = $data;
                $result->num_rows = $this->statement->rowCount();
            }
        } catch (\PDOException $e) {
            trigger_error('Error: ' . $e->getMessage() . ' Error Code : ' . $e->getCode() . ' <br />' . $sql);
            exit();
        }

        if ($result) {
            return $result;
        } else {
            $result = new \stdClass();
            $result->row = array();
            $result->rows = array();
            $result->num_rows = 0;
            return $result;
        }
    }

    /**
     *  claen data
     */
    public function escape($value)
    {
        $search = array("\\", "\0", "\n", "\r", "\x1a", "'", '"');
        $replace = array("\\\\", "\\0", "\\n", "\\r", "\Z", "\'", '\"');
        return str_replace($search, $replace, $value);
    }

    /**
     *  return last id insert
     */
    public function getLastId()
    {
        return $this->pdo->lastInsertId();
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    public function findOne($tableName, $where, $choice = "*")
    {
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));

        $query = "SELECT $choice FROM $tableName WHERE $sql";
        $this->statement = self::prepare($query);

        if ($this->statement) {
            foreach ($where as $key => $item) {
                $this->statement->bindValue(":$key", $item);
            }

            if ($this->statement->execute()) {
                return $this->statement->fetchObject();
            }
        }
        return false;
    }



    public function __destruct()
    {
        $this->pdo = null;
    }
}