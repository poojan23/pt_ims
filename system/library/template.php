<?php

class Template
{
    private $adapter;

    public function __construct($adapter) {
        $class = "Template\\" . $adapter;

        if(class_exists($class)) {
            $this->adapter = new $class();
        } else {
            throw new \Exception("Error: Couldn't load template adapter $adapter!", 1);
        }
    }

    public function set($key, $value) {
        $this->adapter->set($key, $value);
    }

    public function render($template) {
        return $this->adapter->render($template);
    }    
}
