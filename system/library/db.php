<?php

class DB
{
    private $driver;

    public function __construct($driver, $host, $user, $pass, $dbname, $port = NULL) {
        $class = 'DB\\' . $driver;

        if(class_exists($class)) {
            $this->driver = new $class($host, $user, $pass, $dbname, $port);
        } else {
            throw new \Exception("Error: Couldn't load the database driver $driver!", 1);
            
        }
    }

    public function query($query) {
        return $this->driver->query($query);
    }

    public function escape($string) {
        return $this->driver->escape($string);
    }

    public function rowCount() {
        return $this->driver->rowCount();
    }

    public function lastInsertId() {
        return $this->driver->lastInsertId();
    }

    public function connected() {
        return $this->driver->connected();
    }
}
