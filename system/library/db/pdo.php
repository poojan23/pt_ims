<?php
namespace DB;
class PDO
{
    private $dbh = null;
    private $error;
    private $stmt = null;

    public function __construct($host, $user, $pass, $dbname, $port = 3306) {
        # Create new PDO
        try {
            $this->dbh = new \PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $dbname, $user, $pass, [\PDO::ATTR_PERSISTENT => true]);
        } catch(\PDOException $e) {
            $this->error = $e->getMessage();
        }

        $this->dbh->exec("SET NAMES 'utf8'");
        $this->dbh->exec("SET CHARACTER SET utf8");
        $this->dbh->exec("SET CHARACTER_SET_CONNECTION=utf8");
        $this->dbh->exec("SET SQL_MODE = ''");
    }

    public function prepare($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = \PDO::PARAM_STR, $length = 0) {
        if($length) {
            $this->stmt->bindValue($param, $value, $type, $length);
        } else {
            $this->stmt->bindValue($param, $value, $type);
        }
    }

    public function execute() {
        try {
            if($this->stmt && $this->stmt->execute()) {
                $data = array();

                while($row = $this->stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }

                $result = new \stdClass();
                $result->row = isset($data[0]) ? $data[0] : array();
                $result->rows = $data;
                $result->num_rows = $this->stmt->rowCount();
            }
        } catch(\PDOException $e) {
            throw new \Exception("Error: $e->getMessage() Error Code: $e->getCode()", 1);
            
        }
    }

    public function query($query, $args = array()) {
        $this->stmt = $this->dbh->prepare($query);

        $result = false;

        try {
            if($this->stmt && $this->stmt->execute($args)) {
                $data = array();

                while($row = $this->stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }

                $result = new \stdClass();
                $result->row = isset($data[0]) ? $data[0] : array();
                $result->rows = $data;
                $result->num_rows = $this->stmt->rowCount();
            }
        } catch(\PDOException $e) {
            throw new \Exception("Error: $e->getMessage() Error Code: $e->getCode() <br /> $sql", 1);
        }

        if($result) {
            return $result;
        } else {
            $result = new \stdClass();
            $result->row = array();
            $result->rows = array();
            $result->num_rows = 0;
            return $result;
        }
    }

    public function escape($value) {
        //return htmlentities($string, ENT_QUOTES, 'UTF-8');
        return str_replace(array("\\", "\0", "\n", "\r", "\x1a", "'", '"'), array("\\\\", "\\0", "\\n", "\\r", "\Z", "\'", '\"'), $value);
    }

    public function rowCount() {
        if($this->stmt) {
            return $this->stmt->rowCount();
        } else {
            return 0;
        }
    }

    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }

    public function isConnected() {
        if($this->dbh) {
            return true;
        } else {
            return false;
        }
    }

    public function __destruct() {
        $this->dbh = null;
    }
}
