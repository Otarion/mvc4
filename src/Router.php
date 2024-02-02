<?php declare(strict_types=1);

namespace MVC;

class Router {
    protected $request;
    protected $routes;

    public function __construct(Request $request) {
        $this->request = $request;
        $this->routes = include 'routes.php';
    }

    public function dispatch() {
            $method = $this->request->getMethod();
            $uri = $this->request->getPathInfo();
        
            foreach ($this->routes as $route) {
                if ($method === $route['method'] && preg_match('#^' . $route['path'] . '$#', $uri)) {
                    $controller = new $route['controller'];
                    $action = $route['action'];
                    $controller->$action();
                    break;
                }
            }
        }
    }    