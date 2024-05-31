<?php

class Router {
    private $routes = [];

    public function add($method, $path, $handler) {
        $this->routes[] = compact('method', 'path', 'handler');
    }

    public function dispatch($method, $path) {
        foreach ($this->routes as $route) {
            if ($route['method'] == $method && $route['path'] == $path) {
                call_user_func($route['handler']);
                return;
            }
        }
        echo "404 Not Found";
    }
}
