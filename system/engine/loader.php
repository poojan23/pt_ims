<?php

class Loader
{
    protected $registry;

    public function __construct($registry) {
        $this->registry = $registry;
    }

    public function controller($route, $data = array()) {
        $route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);

        $trigger = $route;

        $result = $this->registry->get('event')->trigger('controller/' . $trigger . '/before', [&$route, &$data]);

        if($result != null && !$result instanceof Exception) {
            $output = $result;
        } else {
            $action = new Action($route);
            $output = $action->execute($this->registry, [&$data]);
        }

        $result = $this->registry->get('event')->trigger('controller/' . $trigger . '/after', [&$route, &$data, &$output]);

        if($result && !$result instanceof Exception) {
            $output = $result;
        }

        if(!$output instanceof Exception) {
            return $output;
        }
    }

    public function model($route) {
        $route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);

        if(!$this->registry->has('model_' . str_replace('/', '_', $route))) {
            $file = DIR_APPLICATION . 'model/' . $route . '.php';
            $class = 'Model' . preg_replace('/[^a-zA-Z0-9]/', '', $route);

            if(is_file($file)) {
                include_once $file;

                $proxy = new Proxy();

                foreach(get_class_methods($class) as $method) {
                    $proxy->{$method} = $this->callback($this->registry, $route . '/' . $method);
                }

                $this->registry->set('model_' . str_replace('/', '_', (string)$route), $proxy);
            } else {
                throw new \Exception("Error: Couldn't load model $route!", 1);
            }
        }
    }

    protected function callback($registry, $route) {
		return function($args) use($registry, $route) {
			static $model;

			$route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);

			$trigger = $route;

			$result = $registry->get('event')->trigger('model/' . $trigger . '/before', array(&$route, &$args));

			if ($result && !$result instanceof Exception) {
				$output = $result;
			} else {
				$class = 'Model' . preg_replace('/[^a-zA-Z0-9]/', '', substr($route, 0, strrpos($route, '/')));

				$key = substr($route, 0, strrpos($route, '/'));

				if (!isset($model[$key])) {
					$model[$key] = new $class($registry);
				}

				$method = substr($route, strrpos($route, '/') + 1);

				$callable = array($model[$key], $method);

				if (is_callable($callable)) {
					$output = call_user_func_array($callable, $args);
				} else {
					throw new \Exception('Error: Could not call model/' . $route . '!');
				}
			}

			$result = $registry->get('event')->trigger('model/' . $trigger . '/after', array(&$route, &$args, &$output));

			if ($result && !$result instanceof Exception) {
				$output = $result;
			}

			return $output;
		};
	}

    public function view($route, $data = array()) {
        $route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);

        $trigger = $route;

        $template = '';

        $result = $this->registry->get('event')->trigger('view/' . $trigger . '/before', [&$route, &$data, &$template]);

        if($result && !$result instanceof Exception) {
            $output = $result;
        } else {
            $template = new Template($this->registry->get('config')->get('template_engine'));

            foreach($data as $key => $value) {
                $template->set($key, $value);
            }

            $output = $template->render($this->registry->get('config')->get('template_directory') . $route, $this->registry->get('config')->get('template_cache'));
        }

        $result = $this->registry->get('event')->trigger('view/' . $trigger . '/after', [&$route, &$data, &$output]);

        if($result && !$result instanceof Exception) {
            $output = $result;
        }

        return $output;
    }

    public function library($route) {
        $route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);

        $file = DIR_SYSTEM . 'library/' . $route . '.php';
        $class = str_replace('/', '\\', $route);

        if(is_file($file)) {
            include_once $file;

            $this->registry->set(basename($route), new $class($this->registry));
        } else {
            throw new \Exception("Error: Couldn't load library $route!", 1);
        }
    }

    public function helper($route) {
        $route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);

        $file = DIR_SYSTEM . 'helper/' . $route . '.php';

        if(is_file($file)) {
            include_once $file;
        } else {
            throw new \Exception("Error: Couldn't load helper $route!", 1);
        }
    }

    public function config($route) {
        $this->registry-get('event')->trigger('config/' . $route . '/before', [&$route]);

        $this->registry->get('config')->load($route);

        $this->registry->get('event')->trigger('config/' . $route . '/after', [&$route]);
    }

    public function language($route, $key = '') {
        $route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);

        $trigger = $route;

        $result = $this->registry->get('event')->trigger('language/' . $trigger . '/before', [&$route, &$key]);

        if($result && !$result instanceof Exception) {
            $output = $result;
        } else {
            $output = $this->registry->get('language')->load($route, $key);
        }

        $result = $this->registry->get('event')->trigger('language/' . $trigger . '/after', [&$route, &$key, &$output]);

        if($result && !$result instanceof Exception) {
            $output = $result;
        }

        return $output;
    }
}
