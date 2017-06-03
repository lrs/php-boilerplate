<?php

namespace LRS\App\Core;

class Router {
  protected $routes = [
    'GET' => [],
    'POST' => []
  ];

  public static function load($file) {
    // have to create a new instance of Router in static method since $this is unknown.
    // Return it so it may be used for chaining.
    $router = new static;

    require $file;

    return $router;
  }

  public function get($uri, $controller) {
    $this->routes['GET'][$uri] = $controller;
  }

  public function post($uri, $controller) {
    $this->routes['POST'][$uri] = $controller;
  }

  public function direct($uri, $requestMethod) {
    if (array_key_exists($uri, $this->routes[$requestMethod])) {
      return $this->callAction(
        ...explode('@', $this->routes[$requestMethod][$uri])
      );
    }

    return $this->callAction('PageController','notFound');
  }

  protected function callAction($controller, $action) {
    $controller = "LRS\\App\\Controllers\\{$controller}";
    $controller = new $controller;

    if (method_exists($controller, $action)) {
      return $controller->$action();
    }

    throw new Exception("{$controller} has no method for {$action}");
  }
}
