<?php

namespace Core;

class Router
{
    private array $routes = [];

    public function get(string $path, callable $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function resolve(string $method, string $uri)
    {
        $uri = explode("?", $uri)[0];

        foreach ($this->routes[$method] as $route => $callback) {
            $pattern = "@^" . preg_replace('/\{(\w+)\}/', '(?P<\1>[\w\-]+)', $route) . "$@";


            if (preg_match($pattern, $uri, $matches)) {
                return $callback($matches);
            }
        }

        http_response_code(404);
        echo json_encode(["error" => "Endpoint not found"]);
    }
}
