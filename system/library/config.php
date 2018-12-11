<?php

class Config
{
    private $settings = array();

    public function set($key, $value) {
        $this->settings[$key] = $value;
    }

    public function get($key) {
        return isset($this->settings[$key]) ? $this->settings[$key] : null;
    }

    public function has($key) {
        return isset($this->settings[$key]);
    }

    public function load($filename) {
        $file = DIR_CONFIG . $filename . '.php';

        if(file_exists($file)) {
            $_ = array();

            require $file;

            $this->settings = array_merge($this->settings, $_);
        } else {
            trigger_error("Error: Couldn't load config $filename!");
        }
    }
}
