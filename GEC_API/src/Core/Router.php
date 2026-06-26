<?php
namespace Core;

class Router
{
    private array $routes = [];

    public function get(string $path, callable $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post(string $path, callable $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function put(string $path, callable $callback)
    {
        $this->routes['PUT'][$path] = $callback;
    }

    public function delete(string $path, callable $callback)
    {
        $this->routes['DELETE'][$path] = $callback;
    }

    public function resolve(string $method, string $uri)
    {
        header('Content-Type: application/json');

        $uri = explode("?", $uri)[0];

        if (!isset($this->routes[$method])) {
            http_response_code(405);
            echo json_encode(["error" => "Method not allowed"]);
            return;
        }

        foreach ($this->routes[$method] as $route => $callback) {

            $pattern = "@^" . preg_replace('/\{(\w+)\}/', '(?P<\1>[\w\-]+)', $route) . "$@";

            if (preg_match($pattern, $uri, $matches)) {

                // Nettoyage : on retire les index numériques
                $params = array_filter($matches, fn($k) => !is_int($k), ARRAY_FILTER_USE_KEY);

                return $callback($params);
            }
        }

        http_response_code(404);
        echo json_encode(["error" => "Endpoint not found"]);
    }
}
