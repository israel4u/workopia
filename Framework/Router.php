<?php

namespace Framework;

  class Router {
    protected $routes = [];

    public function registerRoutes($uri, $method, $controller) {
      $this->routes[] = [
        'uri' => $uri,
        'method' => $method,
        'controller' => $controller
      ];
    }

    /**
     * Create a GET method
     * 
     * @param $uri string
     * @param $controller string
     * @return void
     */
    public function get($uri, $controller) {
      $this->registerRoutes($uri, 'GET', $controller);
      
    }

     /**
     * Create a POST method
     * 
     * @param $uri string
     * @param $controller string
     * @return void
     */
    public function post($uri, $controller) {
      $this->registerRoutes($uri, 'POST', $controller);
      
    }

     /**
     * Create a EDIT method
     * 
     * @param $uri string
     * @param $controller string
     * @return void
     */
    public function edit($uri, $controller) {
      $this->registerRoutes($uri, 'EDIT', $controller);
      
    }

     /**
     * Create a DELETE method
     * 
     * @param $uri string
     * @param $controller string
     * @return void
     */
    public function delete($uri, $controller) {
      $this->registerRoutes($uri, 'DELETE', $controller);
      
    }

    /**
     * Load error page
     * @param int $httpCode
     * 
     * @return void
     */
    public function error ($httpCode = 404) {
      http_response_code($httpCode);
      loadView("error/{$httpCode}");
      exit;
    }

    /**
     * Route the request
     * 
     * @param $uri string
     * @param $method string
     * @return void
     */
    public function route($uri, $method) {
      foreach($this->routes as $route) {
        if($route['uri'] === $uri && $route['method'] === $method) {
          require basePath('/App/' . $route['controller']);
          return;
        }
      }

      $this->error();      
    }
  }