<?php

class Language
{
    private $default = 'en';
    private $dir;
    public $data = array();

    public function __construct($dir = '') {
        $this->dir = $dir;
    }

    public function get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : $key;
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    public function all() {
        return $this->data;
    }

    public function load($filename, $key = '') {
        if(!$key) {
            $_ = array();

            $file = DIR_LANGUAGE . $this->default . '/' . $filename . '.php';

            if(is_file($file)) {
                require $file;
            }

            $file = DIR_LANGUAGE . $this->dir . '/' . $filename . '.php';

            if(is_file($file)) {
                require $file;
            }

            $this->data = array_merge($this->data, $_);
        } else {
            $this->data[$key] = new Language($this->dir);
            $this->data[$key]->load($filename);
        }

        return $this->data;
    }
}
