<?php
namespace Template;
class PHP
{
    private $data = array();
    
    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    public function render($template) {
        $file = DIR_TEMPLATE . $template . '.php';

        if(is_file($file)) {
            extract($this->data);

            ob_start();

            require $file;

            return ob_get_clean();
        }

        throw new \Exception("Error: Couldn't load template $file!", 1);
        exit();
    }
}
