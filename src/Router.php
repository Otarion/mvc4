<?php declare(strict_types=1);

namespace MVC;

class Router {
    protected $request;
    protected $routes;

    public function __construct(Request $request) {
        $this->request = $request;
        $this->routes = include 'routes.php';
    }
}
