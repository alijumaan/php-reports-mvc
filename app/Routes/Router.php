<?php

namespace App\Routes;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {

        // $currentUrl = $_SERVER['PATH_INFO'] ?? '/'; // work with localhost:8080

        $currentUrl = $_SERVER['REQUEST_URI'] ?? '/';
        if (str_contains($currentUrl, '?')) {
            $currentUrl = substr($currentUrl, 0, strpos($currentUrl, '?'));
        }

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        if ($fn) {
            call_user_func($fn, $this);
        } else {
            echo "Page not found 404";
        }
    }

    public function renderView($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once __DIR__."/../../views/$view.php";
        $content = ob_get_clean();
        include_once __DIR__."/../../views/layouts/master.php";
    }
}
