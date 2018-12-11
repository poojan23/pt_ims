<?php

class Cache
{
    private $adapter;

    public function __construct($adapter, $expire = 3600) {
        $class = 'Cache\\' . $adapter;

        if(class_exists($class)) {
            $this->adapter = new $class($expire);
        } else {
            throw new \Exception("Error: Couldn't load $adapter cache!", 1);
        }
    }

    public function get($key) {
        return $this->adapter->get($key);
    }

    public function set($key, $value) {
        return $this->adapter->set($key, $value);
    }

    public function delete($key) {
        return $this->adapter->delete($key);
    }
}
