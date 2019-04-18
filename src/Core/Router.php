<?php

class Router {
    private $routes = [];

    public function method() {
        return isset($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : 'cli';
    }
    
    public function uri() {
        $self = isset($_SERVER['PHP_SELF']) ? str_replace('index.php/', '', $_SERVER['PHP_SELF']) : '';
        $uri = isset($_SERVER['REQUEST_URI']) ? explode('?', $_SERVER['REQUEST_URI'])[0] : '';
        if ($self !== $uri) {
            $peaces = explode('/', $self);
            array_pop($peaces);
            $start = implode('/', $peaces);
            $search = '/' . preg_quote($start, '/') . '/';
            $uri = preg_replace($search, '', $uri, 1);
        }
        return $uri;
    }
    
    function __call($name, $arguments) {
        return $this->on($name, isset($arguments[0]) ? $arguments[0] : '', isset($arguments[1]) ? $arguments[1] : '');
    }
    
    public function on($method, $path, $callback) {
        $method = strtolower($method);
        if (!isset($this->routes[$method])) {
            $this->routes[$method] = [];
        }
        $uri = substr($path, 0, 1) !== '/' ? '/' . $path : $path;
        $pattern = str_replace('/', '\/', $uri);
        $route = '/^' . $pattern . '$/';
        $this->routes[$method][$route] = $callback;
        return $this;
    }
    function __invoke($method, $uri) {
        return $this->run($method, $uri);
    }
    
    public function run($method, $uri) {
        $method = strtolower($method);
        if (!isset($this->routes[$method])) {
            http_response_code(404);
            include(dirname(__FILE__, 3) . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . 'erro' . DIRECTORY_SEPARATOR . '404.html');
            die();
        }
        foreach ($this->routes[$method] as $route => $callback) {
            if (preg_match($route, $uri, $parameters)) {
                array_shift($parameters);
                return $this->call($callback, $parameters);
            }
        }
        http_response_code(404);
        include(dirname(__FILE__, 3) . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . 'erro' . DIRECTORY_SEPARATOR . '404.html');
        die();
    }

    public function call($callback, $parameters) {
        if (is_callable($callback)) {
            return call_user_func_array($callback, $parameters);
        }
        return null;
    }
}